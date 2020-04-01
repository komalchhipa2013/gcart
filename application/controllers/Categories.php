<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('category_model', 'category');
		$this->load->model('Product_model', 'product');
	}

	/**
	 * [index description]

	 */
	public function index()
	{
		$this->get_all_categories();
	}

	/**
	 * [get_all description]
	 * @param  int  $parent_category_id   categories primary key
	 * @param  int $sub_category_id       sub categories primary key
	 */
	public function get_all_categories()
	{
		$this->data['main_category'] = $this->category->get_parent_category();
		$this->data['sub_category']  = $this->category->get_sub_category();

		$this->template->load('index', 'content', 'products/index', $this->data);
	}

	public function get_parent_category_products()
	{
		$category_id = $this->input->post('category_id');

// $category_id=2;
		if (!empty($category_id))
		{
			$total_rows = $this->category->get_products_rows($category_id);

			$start       = 0;
			$limit       = 4;
			$config      = array();
			$url         = '#';
			$uri_segment = '';

			$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

			$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			if (!empty($page_no))
			{
				$start = ($page_no - 1) * $config['per_page'];
			}

			$products_tags = $this->category->get_products_tags($category_id);

			if (!empty($products_tags))
			{
				$products_tags = implode(',', array_map(function ($entry)
				{
					return $entry['tags'];
				}, $products_tags));
				$products_tags = implode(',', array_unique(explode(',', $products_tags)));

				$products_tags = explode(',', $products_tags);
			}

			$this->data['products_tags']             = $products_tags;
			$this->data['brand_data']                = $this->category->get_brands($category_id);
			$this->data['max_min_price']             = $this->category->get_max_min_products_price($category_id);
			$this->data['link']                      = $this->pagination->create_links();
			$this->data['all_products']              = $this->category->get_products($category_id, null, $limit, $start);
			$this->data['shop_parent_category_data'] = $this->category->get_shop_by_parent_category($category_id);
			$this->data['shop_sub_category_data']    = $this->category->get_shop_by_sub_category($category_id);

			$parent_category_data      = $this->category->get($category_id);
			$banner_id                 = $parent_category_data['banner_id'];
			$this->data['title']       = $parent_category_data['name'];
			$this->data['banner_data'] = $this->category->get_category_banner($banner_id);

			$this->data['asc_price']  = $this->category->get_asc_price_products($category_id, null, $limit, $start);
			$this->data['desc_price'] = $this->category->get_desc_price_products($category_id, null, $limit, $start);
			$this->data['asc_name']   = $this->category->get_asc_name_products($category_id, null, $limit, $start);
			$this->data['desc_name']  = $this->category->get_desc_name_products($category_id);
		}

		echo json_encode($this->data);
	}

	public function get_sub_category_products()
	{
		$sub_category_id   = $this->input->post('sub_category_id');
		$this->data['sub'] = $sub_category_id;

		if (!empty($sub_category_id))
		{
			$total_rows = $this->category->get_products_rows(null, $sub_category_id);

			$start       = 0;
			$limit       = 4;
			$config      = array();
			$url         = '#';
			$uri_segment = '';

			$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

			$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			if (!empty($page_no))
			{
				$start = ($page_no - 1) * $config['per_page'];
			}

			$products_tags = $this->category->get_products_tags(null, $sub_category_id);

			if (!empty($products_tags))
			{
				$products_tags = implode(',', array_map(function ($entry)
				{
					return $entry['tags'];
				}, $products_tags));
				$products_tags = implode(',', array_unique(explode(',', $products_tags)));

				$products_tags = explode(',', $products_tags);
			}

			$this->data['products_tags'] = $products_tags;
			$this->data['brand_data']    = $this->category->get_brands(null, $sub_category_id);
			$this->data['max_min_price'] = $this->category->get_max_min_products_price(null, $sub_category_id);
			$this->data['link']          = $this->pagination->create_links();
			$this->data['all_products']  = $this->category->get_products(null, $sub_category_id, $limit, $start);

			$sub_category_data         = $this->category->get_sub_category($sub_category_id);
			$parent_id                 = $sub_category_data->category_id;
			$parent_category_data      = $this->category->get($parent_id);
			$title                     = $parent_category_data['name'].' / '.ucwords($sub_category_data->name);
			$this->data['title']       = $title;
			$banner_id                 = $parent_category_data['banner_id'];
			$this->data['banner_data'] = $this->category->get_category_banner($banner_id);

			$this->data['asc_price']  = $this->category->get_asc_price_products(null, $sub_category_id, $limit, $start);
			$this->data['desc_price'] = $this->category->get_desc_price_products(null, $sub_category_id, $limit, $start);
			$this->data['asc_name']   = $this->category->get_asc_name_products(null, $sub_category_id, $limit, $start);
			$this->data['desc_name']  = $this->category->get_desc_name_products(null, $sub_category_id, $limit, $start);
		}

		echo json_encode($this->data);
	}

	public function get_asc_price_products()
	{
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$this->data['multiple'] = $multiple_sub_category_id;

		$total_rows = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		$this->data['link']         = $this->pagination->create_links();
		$this->data['all_products'] = $this->category->get_asc_price_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);

		echo json_encode($this->data);
	}

	public function get_desc_price_products()
	{
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$this->data['multiple'] = $multiple_sub_category_id;

		$total_rows = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		$this->data['link']         = $this->pagination->create_links();
		$this->data['all_products'] = $this->category->get_desc_price_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);

		echo json_encode($this->data);
	}

	public function get_asc_name_products()
	{
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$this->data['multiple'] = $multiple_sub_category_id;

		$this->data['brand_id']        = $brand_id;
		$this->data['category_id']     = $category_id;
		$this->data['sub_category_id'] = $sub_category_id;
		$this->data['tags']            = $tags;

		$total_rows = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		$this->data['link']         = $this->pagination->create_links();
		$this->data['all_products'] = $this->category->get_asc_name_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);

		echo json_encode($this->data);
	}

	public function get_desc_name_products()
	{
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$this->data['multiple'] = $multiple_sub_category_id;

		$total_rows = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		$this->data['link']         = $this->pagination->create_links();
		$this->data['all_products'] = $this->category->get_desc_name_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);

		echo json_encode($this->data);
	}

	public function get_tags_products()
	{
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		$this->data['tags']=$tags;

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$total_rows = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		if (!empty($tags))
		{
			$this->data['max_min_price'] = $this->category->get_max_min_products_price($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id, $tags);
			$this->data['all_products']  = $this->category->get_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags);

// if(empty($brand_id))
			// {
			$this->data['brand_data'] = $this->category->get_brands($category_id, $sub_category_id, $multiple_sub_category_id, $tags);

// }

			if (empty($sub_category_id) && empty($multiple_sub_category_id))
			{
				$this->data['shop_sub_category_data'] = $this->category->get_shop_by_sub_category($category_id, null, $tags);
			}

			$this->data['link'] = $this->pagination->create_links();
		}

		echo json_encode($this->data);
	}

	public function get_multiple_sub_category_products()
	{
		$category_id              = $this->input->post('category_id');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');
		$brand_id                 = $this->input->post('brand_id');
		$tags                     = $this->input->post('tags');

		$this->data['multiple'] = $multiple_sub_category_id;

		$total_rows = $this->category->get_products_rows($category_id, null, null, $multiple_sub_category_id, $tags);

		$start       = 0;
		$limit       = 4;
		$config      = array();
		$url         = '#';
		$uri_segment = '';

		$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

		$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		if (!empty($page_no))
		{
			$start = ($page_no - 1) * $config['per_page'];
		}

		$this->data['link']          = $this->pagination->create_links();
		$this->data['max_min_price'] = $this->category->get_max_min_products_price($category_id, null, $brand_id, $multiple_sub_category_id, $tags);
		$this->data['brand_data']    = $this->category->get_brands($category_id, null, $multiple_sub_category_id, $tags);

		$this->data['all_products'] = $this->category->get_products($category_id, null, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);

		$products_tags = $this->category->get_products_tags($category_id, null, $brand_id, $multiple_sub_category_id);

		if (!empty($products_tags))
		{
			$products_tags = implode(',', array_map(function ($entry)
			{
				return $entry['tags'];
			}, $products_tags));
			$products_tags = implode(',', array_unique(explode(',', $products_tags)));

			$products_tags = explode(',', $products_tags);
		}

		
			$this->data['products_tags'] = $products_tags;
		

		echo json_encode($this->data);
	}

// public function products_tags($products_tags)

// {

// 	if (!empty($products_tags))

// 		{

// 			$products_tags = implode(',', array_map(function ($entry)

// 			{

// 				return $entry['tags'];

// 			}, $products_tags));

// 			$products_tags = implode(',', array_unique(explode(',', $products_tags)));

// 			return $products_tags = explode(',', $products_tags);

// 		}
	// }
	public function get_brands_products()
	{
		$brand_id                 = $this->input->post('brand_id');
		$category_id              = $this->input->post('category_id');
		$sub_category_id          = $this->input->post('sub_category_id');
		$tags                     = $this->input->post('tags');
		$multiple_sub_category_id = $this->input->post('multiple_sub_category_id');

		if (!empty($multiple_sub_category_id))
		{
			$multiple_sub_category_id = explode(',', $multiple_sub_category_id);
		}

		$this->data['multiple'] = $multiple_sub_category_id;

// $brand_id                 = 1;

// 		$category_id         =2;

		if (!empty($brand_id))
		{
			$total_rows        = $this->category->get_products_rows($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id);
			$this->data['row'] = $total_rows;
			$start             = 0;
			$limit             = 4;
			$config            = array();
			$url               = '#';
			$uri_segment       = '';

			$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

			$page_no = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			if (!empty($page_no))
			{
				$start = ($page_no - 1) * $config['per_page'];
			}

			$this->data['link']          = $this->pagination->create_links();
			$this->data['all_products']  = $this->category->get_products($category_id, $sub_category_id, $limit, $start, $brand_id, $tags, $multiple_sub_category_id);
			$this->data['max_min_price'] = $this->category->get_max_min_products_price($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id);

			if (empty($sub_category_id) && empty($multiple_sub_category_id))
			{
				$this->data['shop_parent_category_data'] = $this->category->get_shop_by_parent_category($category_id);
				$this->data['shop_sub_category_data']    = $this->category->get_shop_by_sub_category($category_id, $brand_id, $tags);
			}

			$products_tags = $this->category->get_products_tags($category_id, $sub_category_id, $brand_id, $multiple_sub_category_id);

			if (!empty($products_tags))
			{
				$products_tags = implode(',', array_map(function ($entry)
				{
					return $entry['tags'];
				}, $products_tags));
				$products_tags = implode(',', array_unique(explode(',', $products_tags)));

				$products_tags = explode(',', $products_tags);
			}

			
				$this->data['products_tags'] = $products_tags;
			
		}

		echo json_encode($this->data);
	}

	/**
	 * [get_parent_categories_brands_products description]
	 * @return  parent categories wise and brand wise return products
	 */

// public function get_parent_categories_brands_products()

// {

// 	$brand_id = $this->uri->segment(3);

// 	$parent_category_id = $this->uri->segment(4);

// 	$this->data['parent_id'] = $parent_category_id;

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows($parent_category_id, null, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_categories_brands_products/'.$brand_id.'/'.$parent_category_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products($parent_category_id, null, $limit, $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($parent_category_id);

// }

// /**

//  * [get_parent_categories_brands_products description]

//  * @return  parent categories wise and brand wise return products

//  */

// public function get_sub_categories_brands_products()

// {

// 	$brand_id = $this->uri->segment(3);

// 	$sub_category_id = $this->uri->segment(4);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_categories_brands_products/'.$brand_id.'/'.$sub_category_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products(null, $sub_category_id, $limit, $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_parent_category_products description]

//  * Get Parent categories wise all products

//  */

// public function get_parent_category_products()

// {

// 	$parent_category_id      = $this->uri->segment(3);

// 	$this->data['parent_id'] = $parent_category_id;

// 	$products_rows = $this->category->get_products_rows($parent_category_id, null);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_category_products/'.$parent_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products($parent_category_id, null, $limit, $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($parent_category_id);

// }

// /**

//  * [get_sub_category_products description]

//  * Get Sub categories wise All products

//  */

// public function get_sub_category_products($sub_category_id)

// {

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_products/'.$sub_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products(null, $sub_category_id, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * Get parent categories products in Low to High price

//  *

//  */

// public function get_parent_category_asc_price_products($category_id)

// {

// 	$this->data['parent_id'] = $category_id;

// 	$products_rows = $this->category->get_products_rows($category_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_asc_price_products/'.$category_id.'/';

// 	$uri_segment   = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products($category_id, null, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get parent categories brands products in Low to High price

//  *

//  */

// public function get_parent_category_asc_price_brands_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows($category_id, null, $brand_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_asc_price_brands_products/'.$category_id.'/'.$brand_id.'/';

// 	$uri_segment   = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products($category_id, null, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get sub categories products in Low to High price

//  */

// public function get_sub_category_asc_price_products($sub_category_id)

// {

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_price_products/'.$sub_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products(null, $sub_category_id, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * Get sub categories brands products in Low to High price

//  */

// public function get_sub_category_asc_price_brands_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows          = $this->category->get_products_rows(null, $sub_category_id, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_price_brands_products/'.$sub_category_id.'/'.$brand_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products(null, $sub_category_id, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($sub_category_id);

// }

// /**

//  * Get parent categories products in High to Low price

//  */

// public function get_parent_category_desc_price_products($category_id)

// {

// 	$this->data['parent_id'] = $category_id;

// 	$products_rows = $this->category->get_products_rows($category_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_desc_price_products/'.$category_id.'/';

// 	$uri_segment   = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products($category_id, null, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get parent categories brands products in High to Low price

//  */

// public function get_parent_category_desc_price_brands_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows($category_id, null, $brand_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_desc_price_brands_products/'.$category_id.'/'.$brand_id.'/';

// 	$uri_segment   = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products($category_id, null, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [Get sub categories products in High to Low price

//  */

// public function get_sub_category_desc_price_products()

// {

// 	echo $sub_category_id          = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_price_products/'.$sub_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products(null, $sub_category_id, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [Get sub categories brands products in High to Low price

//  */

// public function get_sub_category_desc_price_brands_products()

// {

// 	echo $sub_category_id          = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_price_brands_products/'.$sub_category_id.'/'.$brand_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products(null, $sub_category_id, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($sub_category_id);

// }

// /**

//  * Get parent categories products in A to Z products name

//  *

//  */

// public function get_parent_category_asc_name_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$products_rows = $this->category->get_products_rows($category_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_asc_name_products/'.$category_id.'/';

// 	$uri_segment   = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products($category_id, null, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get parent categories brands products in A to Z products name

//  *

//  */

// public function get_parent_category_asc_name_brands_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows($category_id, null, $brand_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_asc_name_brands_products/'.$category_id.'/'.$brand_id.'/';

// 	$uri_segment   = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products($category_id, null, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get sub categories products in A to Z products name

//  */

// public function get_sub_category_asc_name_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_name_products/'.$sub_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products(null, $sub_category_id, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * Get sub categories brands products in A to Z products name

//  */

// public function get_sub_category_asc_name_brands_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_name_brands_products/'.$sub_category_id.'/'.$brand_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products(null, $sub_category_id, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * Get parent categories products in Z to A products name

//  */

// public function get_parent_category_desc_name_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$products_rows = $this->category->get_products_rows($category_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_desc_name_products/'.$category_id.'/';

// 	$uri_segment   = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products($category_id, null, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * Get parent categories brands products in Z to A products name

//  */

// public function get_parent_category_desc_nam_brands_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows = $this->category->get_products_rows($category_id, null, $brand_id);

// 	$start         = 0;

// 	$limit         = 4;

// 	$total_rows    = $products_rows;

// 	$config        = array();

// 	$url           = base_url().'Categories/get_parent_category_desc_nam_brands_products/'.$category_id.'/'.$brand_id.'/';

// 	$uri_segment   = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products($category_id, null, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [Get sub categories products in Z to A procuts name

//  */

// public function get_sub_category_desc_name_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$products_rows = $this->category->get_products_rows(null, $sub_category_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_name_products/'.$sub_category_id.'/';

// 	$uri_segment = 4;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products(null, $sub_category_id, $config['per_page'], $start);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * Get sub categories brands products in Z to A procuts name

//  */

// public function get_sub_category_desc_name_brands_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$brand_id               = $this->uri->segment(4);

// 	$this->data['brand_id'] = $brand_id;

// 	$products_rows          = $this->category->get_products_rows(null, $sub_category_id, $brand_id);

// 	$start       = 0;

// 	$limit       = 4;

// 	$total_rows  = $products_rows;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_name_brands_products/'.$sub_category_id.'/'.$brand_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $total_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products(null, $sub_category_id, $config['per_page'], $start, $brand_id);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_sub_categories_price_filter_products description]

//  * @return multiple sub category and set price in price slider wise display products

//  */

// public function get_sub_categories_price_filter_products()

// {

// 	$filter_sub_category_id = $this->input->post('sub_category');

// 	$products_price = $this->input->post('price_slider');

// 	$products_price = (explode(',', $products_price));

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	if (!empty($products_price))

// 	{

// 		$max_price = '';

// 		$min_price = '';

// 		foreach ($products_price as $key => $value)

// 		{

// 			if ($key == 0)

// 			{

// 				$min_price = $value;

// 			}

// 			else

// 			{

// 				$max_price = $value;

// 			}

// 		}

// 	}

// 	if (!empty($filter_sub_category_id) && !empty($products_price))

// 	{

// 		$products_rows = $this->category->sub_category_filter_products_rows($category_id, $filter_sub_category_id, $max_price, $min_price);

// 		$start       = 0;

// 		$limit       = 4;

// 		$config      = array();

// 		$url         = base_url().'Categories/get_sub_categories_price_filter_products/'.$category_id.'/';

// 		$uri_segment = 4;

// 		$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 		$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 		if (!empty($page_no))

// 		{

// 			$start = ($page_no - 1) * $config['per_page'];

// 		}

// 		$this->data['filter_sub_category_id'] = $filter_sub_category_id;

// 		$this->data['all_products']           = $this->category->get_sub_category_and_price_filter_products($category_id, $filter_sub_category_id, $max_price, $min_price);

// 		$this->data['link']                   = $this->pagination->create_links();

// 		$this->get_all($category_id);

// 	}

// 	elseif (!empty($products_price))

// 	{

// 		$products_rows = $this->category->sub_category_filter_products_rows($category_id, null, $max_price, $min_price);

// 		$start       = 0;

// 		$limit       = 4;

// 		$config      = array();

// 		$url         = base_url().'Categories/get_sub_categories_price_filter_products/'.$category_id.'/';

// 		$uri_segment = 4;

// 		$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 		$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 		if (!empty($page_no))

// 		{

// 			$start = ($page_no - 1) * $config['per_page'];

// 		}

// 		$this->data['all_products'] = $this->category->get_sub_category_and_price_filter_products($category_id, null, $max_price, $min_price);

// 		$this->data['link']         = $this->pagination->create_links();

// 		$this->get_all($category_id);

// 	}

// 	elseif (!empty($filter_sub_category_id))

// 	{

// 		$products_rows = $this->category->sub_category_filter_products_rows($category_id, $filter_sub_category_id);

// 		$start       = 0;

// 		$limit       = 4;

// 		$config      = array();

// 		$url         = base_url().'Categories/get_sub_categories_price_filter_products/'.$category_id.'/';

// 		$uri_segment = 4;

// 		$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 		$page_no = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

// 		if (!empty($page_no))

// 		{

// 			$start = ($page_no - 1) * $config['per_page'];

// 		}

// 		$this->data['filter_sub_category_id'] = serialize($filter_sub_category_id);

// 		$this->data['all_products']           = $this->category->get_sub_category_and_price_filter_products($category_id, $filter_sub_category_id);

// 		$this->data['link']                   = $this->pagination->create_links();

// 		$this->get_all($category_id);

// 	}

// }

// /**

//  * [get_patent_category_tags_products description]

//  * @return parent category and tags wise display products

//  */

// public function get_patent_category_tags_products()

// {

// 	$category_id             = $this->uri->segment(4);

// 	$this->data['parent_id'] = $category_id;

// 	$tags                    = $this->uri->segment(3);

// 	$this->data['tags_name'] = $tags;

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_patent_category_tags_products/'.$tags.'/'.$category_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products($category_id, null, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [get_sub_category_tags_products description]

//  * @return sub category and tags wise display products

//  */

// public function get_sub_category_tags_products()

// {

// 	$sub_category_id               = $this->uri->segment(4);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$tags                          = $this->uri->segment(3);

// 	echo $products_rows = $this->category->get_products_rows(null, $sub_category_id, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_tags_products/'.$tags.'/'.$sub_category_id.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_products(null, $sub_category_id, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_parent_category_asc_price_tags_products description]

//  * @return parent category and tags wise order by ascending price products

//  */

// public function get_parent_category_asc_price_tags_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	echo $tags               = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_category_asc_price_tags_products/'.$category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products($category_id, null, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [get_parent_category_desc_price_tags_products description]

//  * @return parent category and tags wise order by descending price products

//  */

// public function get_parent_category_desc_price_tags_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$tags                    = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_category_asc_price_tags_products/'.$category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products($category_id, null, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [get_parent_category_asc_name_tags_products description]

//  * @return parent category and tags wise order by ascending name products

//  */

// public function get_parent_category_asc_name_tags_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$tags                    = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_category_asc_name_tags_products/'.$category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products($category_id, null, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [get_parent_category_desc_price_tags_products description]

//  * @return parent category and tags wise order by descending name products

//  */

// public function get_parent_category_desc_name_tags_products()

// {

// 	$category_id             = $this->uri->segment(3);

// 	$this->data['parent_id'] = $category_id;

// 	$tags                    = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_parent_category_desc_name_tags_products/'.$category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products($category_id, null, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all($category_id);

// }

// /**

//  * [get_sub_category_asc_price_tags_products description]

//  * @return sub category and tags wise order by ascending price products

//  */

// public function get_sub_category_asc_price_tags_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$tags                          = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_price_tags_products/'.$sub_category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_price_products(null, $sub_category_id, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_sub_category_desc_price_tags_products description]

//  * @return sub category and tags wise order by descending price products

//  */

// public function get_sub_category_desc_price_tags_products()

// {

// 	echo $this->input->post('patent_id');

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$tags                          = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_price_tags_products/'.$sub_category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_price_products(null, $sub_category_id, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_sub_category_asc_name_tags_products description]

//  * @return sub category and tags wise order by ascending name products

//  */

// public function get_sub_category_asc_name_tags_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$tags                          = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_asc_name_tags_products/'.$sub_category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_asc_name_products(null, $sub_category_id, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// /**

//  * [get_sub_category_desc_name_tags_products description]

//  * @return sub category and tags wise order by descending name products

//  */

// public function get_sub_category_desc_name_tags_products()

// {

// 	$sub_category_id               = $this->uri->segment(3);

// 	$this->data['sub_category_id'] = $sub_category_id;

// 	$tags                          = $this->uri->segment(4);

// 	$products_rows = $this->category->get_products_rows($category_id, null, null, null, $tags);

// 	$start       = 0;

// 	$limit       = 4;

// 	$config      = array();

// 	$url         = base_url().'Categories/get_sub_category_desc_name_tags_products/'.$sub_category_id.'/'.$tags.'/';

// 	$uri_segment = 5;

// 	$config = $this->init_pagination($url, $products_rows, $limit, $uri_segment);

// 	$page_no = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

// 	if (!empty($page_no))

// 	{

// 		$start = ($page_no - 1) * $config['per_page'];

// 	}

// 	$this->data['all_products'] = $this->category->get_desc_name_products(null, $sub_category_id, $limit, $start, null, $tags);

// 	$this->data['link']         = $this->pagination->create_links();

// 	$this->get_all(null, $sub_category_id);

// }

// public function shop_category()

// {

// 	$sub_category_id = $this->input->post('sub_category_id');

// 	if (!empty($sub_category_id))

// 	{

// 		$products = $this->category->shop_sub_category_products($sub_category_id);

// 		foreach ($$products as $key => $data)

// 		{

// 			$this->data['imag'] = $data->thumb_image;

// 			if ($data->is_sale == 1)

// 			{

// 				$this->data['sale'] = $data->is_sale;

// 			}

// 			$this->data['name']=$data->name;

// 		}

// 		echo json_encode($this->data);

// 	}
	// }
};
