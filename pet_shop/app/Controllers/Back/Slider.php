<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Entities\Slider as EntitiesSlider;
use App\Models\SliderModel;

class Slider extends BaseController
{
    public function __construct()
    {
        $this->sliderEntity = new EntitiesSlider();
        $this->sliderModel = new SliderModel();
    }

    public function index()
    {
        return view('Back/Slider/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'sliders' => $this->sliderModel->findAll(),
        ]);
    }

    public function create()
    {
        $imgFile  = $this->request->getFile('image');

        if (!$this->validateImage()) {
            session()->setFlashdata('error', $this->validator->getError());
            return redirect()->back()->withInput();
        } else {
            $picName = $this->storeSliderImage($imgFile);

            $this->sliderEntity->pic = $picName;
            $sliderData = $this->sliderEntity->fill($this->request->getPost());

            return ($this->sliderModel->insert($sliderData))
                ? redirect()->to('admin/slider')->with('success', 'New slider was successfully added.')
                : redirect()->back()->with('errors', $this->sliderModel->errors())->withInput();
        }
    }

    public function edit($sliderID)
    {
        return view('Back/Slider/edit', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'slider' => $this->sliderModel->where('slider_id', $sliderID)->first(),
        ]);
    }

    public function update($sliderID)
    {
        $imgFile  = $this->request->getFile('image');
        $img_upload = $_FILES["image"]["error"]; //get error data
        $sliderData = $this->sliderEntity->fill($this->request->getPost());

        if (!$img_upload == 4) { // Has uploaded image or not / error empty file
            if ($this->validateImage()) {
                //naming and move images
                $picName = $this->storeSliderImage($imgFile);
                if ($picName != null) {
                    //delete existed/previous slider image
                    $this->deleteExistedImage($sliderID);
                    //get new pic name
                    $this->sliderEntity->pic = $picName;
                    $this->sliderModel->update($sliderID, $sliderData);
                    return redirect()->to('admin/slider')->with('success', 'Slider was successfully updated.');
                } else
                    redirect()->back()->with('errors', $this->sliderModel->errors())->withInput();
            } else
                return redirect()->back()->with('error', $this->validator->getError())->withInput();
        }
        $this->sliderModel->update($sliderID, $sliderData);
        return redirect()->to('admin/slider')->with('success', 'Slider was successfully updated.');
    }

    public function delete($sliderID)
    {
        $this->deleteExistedImage($sliderID);
        if ($this->sliderModel->where('slider_id', $sliderID)->delete()) {
            return redirect()->to('admin/slider')->with('success', 'Slider was successfully deleted.');
        } else {
            return redirect()->to('admin/slider')->with('success', 'Something wrong! Slider was unsuccessfully deleted.');
        }
    }

    private function validateImage()
    {
        return
            $this->validate([
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,3072]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Please upload any image first.',
                        'max_size' => 'Image size is exceeded 3MB',
                        'is_image' => 'File choosen is not an image type.',
                        'mime_in' => 'File choosen is not in jpg, jpeg, or png format.',
                    ]
                ]
            ]);
    }

    private function storeSliderImage($imgFile)
    {
        $newName = $imgFile->getRandomName();

        $imgFile->move('slider-images/', $newName);

        return 'slider-images/' . $newName;
    }

    private function deleteExistedImage($sliderID)
    {
        helper('filesystem');

        $sliderData = $this->sliderModel->where('slider_id', $sliderID)->first();

        $sliderPic = $sliderData->pic;
        if (is_readable($sliderPic)) {
            unlink($sliderPic);
        } else echo "Images not found.";

        return 1;
    }
}
