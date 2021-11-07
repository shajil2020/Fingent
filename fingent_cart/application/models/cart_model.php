<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function update_cart($rowid, $qty, $price, $amount) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);

		$this->cart->update($data);
	}
 function insert_order($order_details=null){

    $this->db->insert('orders',$order_details);
    return $this->db->insert_id();

 }

function insert_order_details($order_details=null)
{
   $this->db->trans_start();
    $this->db->insert('order_detail',$order_details);
    $this->db->trans_complete();
    return $this->db->insert_id();

}

function get_order($id=null)
{
       $this->db->where('serial',$id);
       $query = $this->db->get('orders');
       $result = $query->result_array();
       return $result;
}
function get_order_products($orderid=null)
{
       $this->db->where('orderid',$orderid);
       $query = $this->db->get('order_detail');
       $result = $query->result_array();
       return $result;
}



}