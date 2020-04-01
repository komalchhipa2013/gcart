<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model', 'products');
		$this->load->model('category_model', 'category');
	}

	public function index()
	{
		// $this->set_page_title('Category');
	}

	/**
	 * [show_detail description]
	 * @return [type] [description]
	 */
	public function show_detail($product_id)
	{
		$products_data = $this->products->get($product_id);
		$category_id   = $products_data['category_id'];

		$category_data = $this->category->get_parent_category($category_id);

		foreach ($category_data as $key => $category)
		{
			$this->data['category_name'] = $category->name;
			$this->data['category_id']   = $category->id;
		}

		$this->data['reviews']            = $this->products->count_products_review($product_id);
		$this->data['products_name']      = $products_data['name'];
		$this->data['upsell_products']    = $this->products->get_upsell_products();
		$this->data['hot_deals_products'] = $this->products->get_hot_deals_products();
		$this->data['products_detail']    = $this->products->get($product_id);

		$this->template->load('index', 'content', 'products/details', $this->data);
	}

	public function add_cart_products()
	{
		$product_id      = $this->input->post('products_id');
		$products_data   = $this->products->get($product_id);
		$products_amount = $products_data['new_price'];
		$date            = date('Y-m-d h:i:scandir(directory)');

		$data = array(
			'product_id'   => $product_id,
			'quantity'     => 1,
			'total_amount' => $products_amount,
			'date'         => $date
		);

		$this->products->add_to_cart($data);
	}

	public function add_wishlist_products()
	{
		$product_id      = $this->input->post('products_id');
		$all_products_id = $this->products->get_wishlist_data(1);

		if (!empty($product_id))
		{
			$ids = array();

			foreach ($all_products_id as $product)
			{
				// if ($product->product_id != $product_id)
				// {
					array_push($ids, $product->product_id);
				// }
			}
			// print_r($ids);

			if (!in_array($product_id, $ids, TRUE))
			{
				$data = array(

					'user_id'    => 1,

					'product_id' => $product_id

				);

				$result = $this->products->add_wishlist_products($data);

				// if ($result == TRUE)
				// {
				// 	echo 'Add successfully';
				// }
			}
			// else
			// {
			// 	echo 'All ready add in wish list';
			// }
		}
	}
}
