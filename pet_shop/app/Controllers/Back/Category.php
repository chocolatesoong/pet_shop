<?php

namespace App\Controllers\Back;

use App\Controllers\BaseController;
use App\Entities\Category as EntitiesCategory;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->categoryEntity = new EntitiesCategory();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $model = model('CategoryModel');
        $this->categories = $model->findAll();
        return view('Back/Category/index', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'validation' => \Config\Services::validation(),
            'categories' => $this->categories,
        ]);
    }

    /**
     * Create Category from POST form
     * @return App\View
     */
    public function create()
    {
        $validation = [
            'category' => [
                'rules' => 'is_unique[category.category_name,category_id,{category_id}]',
                'errors' => [
                    'is_unique' => 'The {field} is already created.',
                ]
            ]
        ];

        if (!$this->validate($validation)) {
            return redirect()->back()->with('errors', $this->validator->getError())->withInput();
        } else {
            $data = $this->categoryEntity->fill($this->request->getPost());
            $this->categoryModel->save($data);
            return redirect()->to('/admin/category')->with('success', "New category was successfully added.");
        }


        // return redirect()->to('/admin/product/add');
    }

    /**
     * Edit Controller
     *
     * @param [type] $category_id
     *
     * @return App\View
     */
    public function edit($category_id)
    {
        $category_model = model('CategoryModel')->findCategoryByCategoryId($category_id);

        // Check whether Category exist
        $this->categories = $this->getCategoryOr404($category_id);

        return view('Back/Category/category_edit', [
            'loggedSellerData' => BaseController::getLoggedSeller(),
            'category' => $this->categories
        ]);
    }

    /**
     * Update Category from POST form
     * @return App\View
     */
    public function update()
    {
        // get POST data
        $posts = $this->request->getPost();

        // Initialization
        $model = model('CategoryModel');

        // Security Check: Is Category Id available?
        if (empty($posts['category_id'])) {
            return redirect()->back()->withInput()->with('warning', 'Invalid Operation!');
        }

        // Security Check: Is Category Id Valid?
        $this->categories = $this->getCategoryOr404($posts['category_id']);

        // Process POST Data
        $this->categories->fill($posts);

        // Update Category
        if (!$model->update($posts['category_id'], $this->categories->toRawArray())) {
            return redirect()->back()->withInput()->with('warning', 'Operation Failed');
        }

        // Update Operation Success
        return redirect()->to('admin/category')->with('info', 'Updated Successfully');
    }

    public function delete($category_id)
    {
        $this->getCategoryOr404($category_id);
        if (model('CategoryModel')->delete($category_id)) {
            return redirect()->to('admin/category')->with('info', 'Deleted Succesfully');
        } else {
            return redirect()->back()->withInput()->with('warning', 'Deletion Failed');
        }
    }

    /**
     *  Get Category
     *  if no category is found, throw PageNotFoundException
     *
     * @param [type] $category_id
     *
     * @return App\Entities\Category
     */
    private function getCategoryOr404($category_id): \App\Entities\Category
    {
        $category = model('CategoryModel')->find($category_id);
        if ($category == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category with id ' . $category_id . ' is not found');
        }

        return $category;
    }
}
