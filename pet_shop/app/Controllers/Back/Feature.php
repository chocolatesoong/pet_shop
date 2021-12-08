<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Entities\Feature as EntitiesFeature;
use App\Models\FeatureModel;

class Feature extends BaseController
{
    public function __construct()
    {
        $this->featureEntity = new EntitiesFeature();
        $this->featureModel = new FeatureModel();
    }

    public function index()
    {
        return view('Back/Feature/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'features' => $this->featureModel->findAll(),
        ]);
    }

    public function create()
    {
        $imgFile  = $this->request->getFile('image');

        if (!$this->validateImage()) {
            session()->setFlashdata('error', $this->validator->getError());
            return redirect()->back()->withInput();
        } else {
            $picName = $this->storeFeatureImage($imgFile);

            $this->featureEntity->pic = $picName;
            $featureData = $this->featureEntity->fill($this->request->getPost());

            return ($this->featureModel->insert($featureData))
                ? redirect()->to('admin/feature')->with('success', 'New feature was successfully added.')
                : redirect()->back()->with('errors', $this->featureModel->errors())->withInput();
        }
    }

    public function edit($featureID)
    {
        return view('Back/Feature/edit', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'feature' => $this->featureModel->where('feature_id', $featureID)->first(),
        ]);
    }

    public function update($featureID)
    {
        $imgFile  = $this->request->getFile('image');
        $img_upload = $_FILES["image"]["error"]; //get error data
        $featureData = $this->featureEntity->fill($this->request->getPost());

        if (!$img_upload == 4) { // Has uploaded image or not / error empty file
            if ($this->validateImage()) {
                //naming and move images
                $picName = $this->storeFeatureImage($imgFile);
                if ($picName != null) {
                    //delete existed/previous feature image
                    $this->deleteExistedImage($featureID);
                    //get new pic name
                    $this->featureEntity->pic = $picName;
                    $this->featureModel->update($featureID, $featureData);
                    return redirect()->to('admin/feature')->with('success', 'Feature was successfully updated.');
                } else
                    redirect()->back()->with('errors', $this->featureModel->errors())->withInput();
            } else
                return redirect()->back()->with('error', $this->validator->getError())->withInput();
        }
        $this->featureModel->update($featureID, $featureData);
        return redirect()->to('admin/feature')->with('success', 'Feature was successfully updated.');
    }

    public function delete($featureID)
    {
        $this->deleteExistedImage($featureID);
        if ($this->featureModel->where('feature_id', $featureID)->delete()) {
            return redirect()->to('admin/feature')->with('success', 'Feature was successfully deleted.');
        } else {
            return redirect()->to('admin/feature')->with('success', 'Something wrong! Feature was unsuccessfully deleted.');
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

    private function storeFeatureImage($imgFile)
    {
        $newName = $imgFile->getRandomName();

        $imgFile->move('feature-images/', $newName);

        return 'feature-images/' . $newName;
    }

    private function deleteExistedImage($featureID)
    {
        helper('filesystem');

        $featureData = $this->featureModel->where('feature_id', $featureID)->first();

        $featurePic = $featureData->pic;
        if (is_readable($featurePic)) {
            unlink($featurePic);
        } else echo "Images not found.";

        return 1;
    }
}
