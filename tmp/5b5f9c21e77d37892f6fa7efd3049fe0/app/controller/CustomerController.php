<?php
namespace www\controller;

use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use www\Auth;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\CustomerFinancial;
use www\model\CustomerQualification;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class CustomerController extends BaseController implements ControllerInterface {
    /**
     * get relate model name
     * @return string
     */
    public function getModel(){
        return 'www\model\Customer';
    }

	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(
                'fields' => array('*', '-create_time', '-op_user_id', '-address', '-desc', '-source_desc', '-type_desc', '-site'),
            ),
			self::OP_UPDATE => array(
                'fields' => array('*', '-create_time', '-op_user_id'),
            ),
			self::OP_INFO   => array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('customer_no', 'company_alias_name', 'type')
			)
		);
	}

    /**
     * @param $get
     * @param $post
     * @return \Lite\Core\Result
     */
	public function update($get, $post){
        if($post){
            $post['op_user_id'] = Auth::instance()->getLoginUserId();
        }
		$result = parent::update($get, $post);
		if($post){
			$data = $result->getData();
			$result->setJumpUrl(Router::getUrl('Customer/info', array(
				'id' => $data['id'],
			)));
		}
		return $result;
	}

    /**
     * @param $get
     * @return array
     */
    public function info($get){
        $id = $get['id'];
        $customer = Customer::findOneByPk($id);
        $customer_contact_list = CustomerContact::find('customer_id = ?', $id)->all();
        $customer_qualification_list = CustomerQualification::find('customer_id = ?', $id)->all();
        $customer_financial_list = CustomerFinancial::find('customer_id = ?', $id)->all();

        return array(
            'customer'                    => $customer,
            'customer_contact_list'       => $customer_contact_list,
            'customer_qualification_list' => $customer_qualification_list,
            'customer_financial_list'     => $customer_financial_list,
        );
    }

	/**
	 * @param $get
	 */
	public function ajaxSearchCustomerList($get){
		$search_text = $get['search_text'];
		$like_param = '%' . trim($search_text) . '%';

		$customer_list = Customer::find("company_alias_name like ? or company_full_name like ? or customer_no like ?", $like_param, $like_param, $like_param)
			->select('id, customer_no, company_alias_name ')
			->order('id asc')
			->limit(50)
			->all(true);

		echo json_encode($customer_list);
		exit;
	}

}