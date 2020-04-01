<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model
{
	/**
	 * @var mixed
	 */
	protected $soft_delete = TRUE;

	/**
	 * @var string
	 */
	protected $soft_delete_key = 'is_deleted';

	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [get_hot_deals_products description]
	 * @return return Hote Deals products data
	 */
	public function get_hot_deals_products()
	{
		$this->db->select('products.*,hot_deals.id as hot_id,hot_deals.from_date_time,hot_deals.to_date_time,hot_deals.off_percentage');
		$this->db->from('products');
		$this->db->join('hot_deals', 'products.id=hot_deals.product_id', 'inner');
		$this->db->where(array('products.is_deleted' => 0, 'products.is_active' => 1));
		$query = $this->db->get();

		if ($query == TRUE)
		{
			return $query->result();
		}

		return false;
	}

	/**
	 * [get_upsell_products description]
	 * @return [return upsell products
	 */
	public function get_upsell_products()
	{
		$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'is_sale' => 1));

		if ($query == TRUE)
		{
			return $query->result();
		}

		return false;
	}

	public function add_to_cart($data)
	{
		$this->db->insert('cart', $data);
	}

	/**
	 * [count_products_review description]
	 * @param  [int] $product_id  reviews products table forgein key
	 * 
	 * @return boolean            query is true return review data in array
	 */
	public function count_products_review($product_id)
	{
		$query = $this->db->get_where('reviews', array('product_id' => $product_id, 'is_deleted' => 0));

		if ($query == TRUE)
		{
			return $query->num_rows();
		}

		return false;
	}

	/**
	 * [get_wishlist_data description]
	 * @return [boolean] query is true return wish List data in array
	 */
	public function get_wishlist_data($user_id)
	{
		$this->db->select("product_id");
		$query = $this->db->get_where('wishlist', array('is_deleted' => 0,'user_id' => $user_id));

		if ($query == TRUE)
		{
			return $query->result();
		}

		return false;
	}

	public function add_wishlist_products($data)
	{
		$query = $this->db->insert('wishlist', $data);

		return $query;
	}
}
