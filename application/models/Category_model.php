<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category_model extends MY_Model
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
		$this->table = 'sub_categoris;';
	}

	/**
	 * [get_parent_category description]
	 * @return [boolean] Query true return sub catgories or return false
	 */
	public function get_parent_category($id = '')
	{
		if (!empty($id))
		{
			$this->db->order_by('name', 'asc');
			$query = $this->db->get_where('categories', array('is_deleted' => 0, 'is_active' => 1, 'id' => $id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		else
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('categories.*,sub_categories.category_id');
			$this->db->from('categories');
			$this->db->join('sub_categories', 'sub_categories.category_id= categories.id', 'left');
			$this->db->where(array('categories.is_deleted' => 0, 'categories.is_active' => 1));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_shop_by_parent_category description]
	 *
	 * @return [boolean] Query true return main catgories this have to sub categories and products or return false
	 */
	public function get_shop_by_parent_category($category_id)
	{
		$this->db->distinct();
		$this->db->order_by('name', 'asc');
		$this->db->select('categories.*');
		$this->db->from('categories');
		$this->db->join('sub_categories', 'sub_categories.category_id=categories.id', 'inner');
		$this->db->join('products', 'products.category_id=categories.id', 'inner');
		$this->db->where(array('categories.is_active' => 1, 'categories.is_deleted' => 0, 'products.is_deleted' => 0, 'products.is_active' => 1, 'products.category_id' => $category_id));
		$query = $this->db->get();

		if ($query == TRUE)
		{
			return $query->result();
		}

		return false;
	}

	/**
	 * [get_shop_by_sub_category description]
	 * @return [boolean] Query true return sub catgories this have to products  or return false
	 */
	public function get_shop_by_sub_category($category_id = '', $brand_id = '', $tags = '')
	{
		if (!empty($category_id) && !empty($tags))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('sub_categories.*');
			$this->db->from('sub_categories');
			$this->db->join('products', 'products.sub_category_id=sub_categories.id', 'inner');
			$this->db->like('products.tags', $tags, 'both');
			$this->db->where(array('sub_categories.is_active' => 1, 'sub_categories.is_deleted' => 0, 'sub_categories.category_id' => $category_id, 'products.is_deleted' => 0, 'products.is_active' => 1));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($brand_id))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('sub_categories.*');
			$this->db->from('sub_categories');
			$this->db->join('products', 'products.sub_category_id=sub_categories.id', 'inner');
			$this->db->where(array('sub_categories.is_active' => 1, 'sub_categories.is_deleted' => 0, 'sub_categories.category_id' => $category_id, 'products.is_deleted' => 0, 'products.is_active' => 1, 'products.brand_id' => $brand_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('sub_categories.*');
			$this->db->from('sub_categories');
			$this->db->join('products', 'products.sub_category_id=sub_categories.id', 'inner');
			$this->db->where(array('sub_categories.is_active' => 1, 'sub_categories.is_deleted' => 0, 'sub_categories.category_id' => $category_id, 'products.is_deleted' => 0, 'products.is_active' => 1));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_sub_category description]
	 * @param  int $id     sub categories primary key
	 *
	 * @return [boolean]   Query is true return sub category or return false
	 */
	public function get_sub_category($id = '')
	{
		if (!empty($id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->where(array('is_deleted' => 0, 'id' => $id));
			$query = $this->db->get('sub_categories');

			if ($query == TRUE)
			{
				foreach ($query->result() as $key => $value)
				{
					return $value;
				}
			}
		}
		else
		{
			$this->db->order_by('name', 'asc');
			$query = $this->db->get('sub_categories');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_category_banner description]
	 * @param  int $id   	primary key
	 *
	 * @return [boolean]    Query is true return category  wise banner detail or return false
	 */
	public function get_category_banner($id = '')
	{
		if ($id)
		{
			$query = $this->db->get_where('banners', array('is_deleted' => 0, 'id' => $id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		else
		{
			$query = $this->db->get('banners');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_brands description]
	 * @param  int $category_id    	   products categories forgeign Key
	 * @param  int  $sub_category_id   products sub categories foreign key
	 *
	 * @return [boolean]               query is true then return brand detail category and sub categories wise or return false
	 */
	public function get_brands($category_id = '', $sub_category_id = '', $multiple_sub_category_id = '', $tags = '')
	{
		if (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->like('products.tags', $tags, 'both');
			$this->db->where_in('products.sub_category_id', $multiple_sub_category_id);
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.category_id' => $category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->like('products.tags', $tags, 'both');
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.category_id' => $category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->like('products.tags', $tags, 'both');
			$this->db->where_in('products.sub_category_id', $multiple_sub_category_id);
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.sub_category_id' => $sub_category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->where_in('products.sub_category_id', $multiple_sub_category_id);
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.category_id' => $category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.category_id' => $category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->distinct();
			$this->db->order_by('name', 'asc');
			$this->db->select('brands.*,products.sub_category_id');
			$this->db->from('brands');
			$this->db->join('products', 'products.brand_id= brands.id', 'inner');
			$this->db->where(array('products.is_active' => 1, 'products.is_deleted' => 0, 'brands.is_deleted' => 0, 'products.sub_category_id' => $sub_category_id));
			$query = $this->db->get();

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_products description]
	 * @param  int $category_id         category primary key
	 * @param  int  $sub_category_id  sub categories primary key
	 * @param  int $limit             limit to diaply products in per page
	 * @param  int $start             start row in per page
	 * @param  int $brand_id          products brands foreign key
	 *
	 * @return [boolean]              parent id is not null return parent categories products  & sun category id is not null return sub category products or false
	 */
	public function get_products($category_id = '', $sub_category_id = '', $limit = '', $start = '', $brand_id = '', $tags = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($multiple_sub_category_id) && !empty($category_id))
		{
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($tags) && !empty($category_id))
		{
			$this->db->limit($limit, $start);

			$this->db->like('tags', $tags, 'both');
			// $this->db->or_like('name', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($tags) && !empty($sub_category_id))
		{
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			//$this->db->or_like('name', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			//$this->db->or_like('name', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			//$this->db->or_like('name', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($brand_id))
		{
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($brand_id))
		{
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		else
		{
			// $this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	/**
	 * [get_products_rows description]
	 *
	 * @param  int $category_id        category primary key
	 * @param  int $sub_category_id  sub category primary key
	 *
	 * @return [boolean]             return number of rows
	 */
	public function get_products_rows($category_id = '', $sub_category_id = '', $brand_id = '', $multiple_sub_category_id = '', $tags = '')
	{
		if (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($category_id))
		{
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		else
		{
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1));

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}

		return false;
	}

/**
 * [get_asc_price_products description]
 *
 * @param  int $category_id       parent categories primary key
 * @param  int $sub_category_id   sub categories primary key
 * @param  int $brand_id          brands primary key
 *
 * @return [boolean]              category id is not null return parent categories products in Low to High price & sun category id is not null return sub category products in Low to High price
 */
	public function get_asc_price_products($category_id = '', $sub_category_id = '', $limit = '', $start = '', $brand_id = '', $tags = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->order_by('new_price', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

/**
 * [get_asc_price_products description]
 *
 * @param  int $category_id      parent categories primary key
 * @param  int $sub_category_id  sub categories promary key
 *
 * @return [boolean]             category id is not null return parent categories products in High to Low price & sun category id is not null return sub category products in High to Low price
 */
	public function get_desc_price_products($category_id = '', $sub_category_id = '', $limit = '', $start = '', $brand_id = '', $tags = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags) && !empty($brand_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'brand_id' => $brand_id, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');

			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->order_by('new_price', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

/**
 * [get_asc_price_products description]
 *
 * @param  int $category_id      parent categories primary key
 * @param  int $sub_category_id  sub categories promary key
 *
 * @return [boolean]             category id is not null return parent categories products in A to Z products name & sun category id is not null return sub category products in  A to Z products name
 */
	public function get_asc_name_products($category_id = '', $sub_category_id = '', $limit = '', $start = '', $brand_id = '', $tags = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($brand_id) && !empty($tags))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($brand_id) && !empty($tags))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->order_by('name', 'asc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

/**
 * [get_asc_price_products description]
 *
 * @param  int $category_id    	 parent categories primary key
 * @param  int $sub_category_id  sub categories promary key
 *
 * @return [boolean]   			 category id is not null return parent categories products in Z to A products name & sun category id is not null return sub category products in  Z to A products name
 */
	public function get_desc_name_products($category_id = '', $sub_category_id = '', $limit = '', $start = '', $brand_id = '', $tags = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($brand_id) && !empty($tags))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($brand_id) && !empty($tags))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$this->db->like('tags', $tags, 'both');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->order_by('name', 'desc');
			$this->db->limit($limit, $start);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

/**
 * [get_sub_category_filter_products description]
 * @param  [int] $sub_category_id 	products sun category foreign key
 * @param  [int] $limit           	limit for display row in per page
 *
 * @return [boolean]                query is true return multiple categories wise products
 */
	public function get_sub_category_and_price_filter_products($category_id, $sub_category_id = '', $max_price = '', $min_price = '')
	{
		if (!empty($sub_category_id) && !empty($max_price) && !empty($min_price))
		{
			$this->db->where('new_price >=', $min_price);
			$this->db->where('new_price <=', $max_price);
			$this->db->where('category_id', $category_id);
			$this->db->where_in('sub_category_id', $sub_category_id);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($max_price) && !empty($min_price))
		{
			$this->db->where('new_price >=', $min_price);
			$this->db->where('new_price <=', $max_price);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}
		elseif (!empty($sub_category_id))
		{
			// $this->db->limit($limit, $start);
			$this->db->where('category_id', $category_id);
			$this->db->where_in('sub_category_id', $sub_category_id);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	public function sub_category_filter_products_rows($category_id, $filter_sub_category_id = '', $max_price = '', $min_price = '')
	{
		if (!empty($filter_sub_category_id) && !empty($max_price) && !empty($min_price))
		{
			$this->db->where('new_price >=', $min_price);
			$this->db->where('new_price <=', $max_price);
			$this->db->where('category_id', $category_id);
			$this->db->where_in('sub_category_id', $filter_sub_category_id);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($max_price) && !empty($min_price))
		{
			$this->db->where('new_price >=', $min_price);
			$this->db->where('new_price <=', $max_price);
			$this->db->where('category_id', $category_id);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
		elseif (!empty($filter_sub_category_id))
		{
			$this->db->where('category_id', $category_id);
			$this->db->where_in('sub_category_id', $filter_sub_category_id);
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->num_rows();
			}
		}
	}

/**
 * [get_max_min_products_price description]
 * @param  int $category_id           		products category foreign key
 * @param  int $sub_category          		products sub categories foregin key
 * @param  int $brands_id             		products brands foregin key
 * @param  array $filter_sub_category_id 	products sun categoris foregin key
 *
 */
	public function get_max_min_products_price($category_id = '', $sub_category_id = '', $brand_id = '', $multiple_sub_category_id = '', $tags = '')
	{
		if (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($tags))
		{
			$this->db->like('tags', $tags, 'both');
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id) && !empty($brand_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($category_id) && !empty($tags))
		{
			$this->db->like('tags', $tags, 'both');
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($sub_category_id) && !empty($tags))
		{
			$this->db->like('tags', $tags, 'both');
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($brand_id) && !empty($category_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($brand_id) && !empty($sub_category_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->select_max('new_price', 'max_price');
			$this->db->select_min('new_price', 'min_price');
			$query = $this->db->get_where('products', array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));

			if ($query == TRUE)
			{
				foreach ($query->result() as $data)
				{
					return $data;
				}
			}
		}
	}

/**
 * [get_products_tags description]
 * @param  int $category_id         products category foregin key
 * @param  int $sub_category_id     products sub category forgin key
 *
 * @return [boolean]                category id is not null when return category  wise products tags and sub category id is not null when retuen sub category  wise products tags
 */
	public function get_products_tags($category_id = '', $sub_category_id = '', $brand_id = '', $multiple_sub_category_id = '')
	{
		if (!empty($category_id) && !empty($brand_id) && !empty($multiple_sub_category_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));
			$query = $this->db->get('products')->result_array();

			if ($query)
			{
				return $query;
			}
		}
		elseif (!empty($category_id) && !empty($multiple_sub_category_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where_in('sub_category_id', $multiple_sub_category_id);
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));
			$query = $this->db->get('products')->result_array();

			if ($query)
			{
				return $query;
			}
		}
		elseif (!empty($category_id) && !empty($brand_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id, 'brand_id' => $brand_id));
			$query = $this->db->get('products')->result_array();

			if ($query)
			{
				return $query;
			}
		}
		elseif (!empty($sub_category_id) && !empty($brand_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id, 'brand_id' => $brand_id));
			$query = $this->db->get('products')->result_array();

			if ($query)
			{
				return $query;
			}
		}
		elseif (!empty($category_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'category_id' => $category_id));
			$query = $this->db->get('products')->result_array();

			if ($query)
			{
				return $query;
			}
		}
		elseif (!empty($sub_category_id))
		{
			$this->db->distinct();
			$this->db->order_by('tags', 'asc');
			$this->db->select('tags');
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1, 'sub_category_id' => $sub_category_id));
			$query = $this->db->get('products')->result_array();

			if ($query == TRUE)
			{
				return $query;
			}
		}
	}

	public function shope_sub_category_products($sub_category_id)
	{
		if (!empty($sub_category_id))
		{
			$this->db->where_in('sub_category_id', $sub_category_id);
			$this->db->where(array('is_deleted' => 0, 'is_active' => 1));
			$query = $this->db->get('products');

			if ($query == TRUE)
			{
				return $query->result();
			}
		}

		return false;
	}

	public function get_data_to_cart_products($product_id)
	{
		$query = $this->db->get_where('products', array('id' => $products_id));

		if ($query == TRUE)
		{
			return $query->result();
		}

		return false;
	}
};
