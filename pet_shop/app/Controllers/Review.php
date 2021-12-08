<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Review as EntitiesReview;
use App\Models\ReviewModel;

use function PHPUnit\Framework\throwException;

class Review extends BaseController
{
    public function __construct()
    {
        $this->reviewEntity = new EntitiesReview();
        $this->reviewModel = new ReviewModel();
    }

    public function create($order_item_id = null, $product_id = null, $customer_id = null, $orderQty = null)
    {
        if ($this->request != null) { // From Customer Side
            $dataReview = $this->reviewEntity;
            $dataReview->fill($this->request->getPost());
            $review_id = $this->request->getPost('review_id');
            if ($this->reviewModel->update($review_id, $dataReview)) {
                return redirect()->to('order')->with("success", "Thank you! Your review for the product is successfully submitted.");
            } else return redirect()->to('order')->withInput();
        } else { // From Admin side
            for ($i = 0; $i < $orderQty; $i++) {
                $dataReview = [
                    'order_item_id' => $order_item_id[$i],
                    'product_id' => $product_id[$i],
                    'customer_id' => $customer_id,
                    'comment' => 'Write your review about the product here...',
                    'rating' => 0,
                ];
                $this->reviewModel->insert($dataReview);
            }
            return 1;
        }
    }
}
