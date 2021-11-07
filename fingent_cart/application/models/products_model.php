<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model
{

	public function __construct()
	{
		//$this->load->database();
	}

	public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
	public function insert_products($products_list = null)
	{
		$this->db->insert('cart_products', $products_list);
	}
	public function get_cart_products()
	{
		$query = $this->db->get('cart_products');
		return $query->result_array();
	}
	public function get_product_count($prodcut_id)
	{
		$this->db->where('product_id', $prodcut_id);
		$query = $this->db->get('cart_products');
		return $query->result_array();
	}
}
