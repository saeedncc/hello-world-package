import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import { Button, Checkbox, Form, Input,Col, Row, message, Select } from 'antd';

import Fun from '../../Fun'


import {
  createTrip,
} from './TripSlice'

import {
  selectAlldriver,
} from '../driver/DriverSlice'

import {
  selectAlltruck,
} from '../truck/TruckSlice'


export default function TripForm({setIsModalOpen}) {
	const dispatch = useDispatch();
	const driver=useSelector(selectAlldriver);
	const truck=useSelector(selectAlltruck);
	
	const [form] = Form.useForm();
	
	const [searchStatus, setSearchStatus] = useState('idle');
	
	const [messageApi, messageShow] = message.useMessage();
	
	
	  const onReset = () => {
		form.resetFields();
	  };
  
  	const onFinish=async (values: any)=>{
		 
		 
		 if(searchStatus=='pending') return false;
		 
		 const {title,driver_id,truck_id}=values;
		 
		 try {
			setSearchStatus('pending');
			
			const params={title:title,driver_id:driver_id,truck_id:truck_id};
			
			Fun.showShadow();
			Fun.showLoader();
			const response=await dispatch(createTrip(params));
						
			Fun.hideShadow();
			Fun.hideLoader();
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
				onReset();
				setIsModalOpen(false);
				
				messageApi.success('trip is saved');

			}else{
				messageApi.error('trip is not saved');
			}
			
			
			
		  } catch (err) {
			console.error('Failed to load data: ', err)
		  } finally {
			setSearchStatus('idle')
		  }
	}

    return (
	
		<>		 
		{messageShow}
		    <Row justify="center" style={{marginTop:'60px'}} >
			  <Col span={24} >
				<Form
				  name="trip"
				  form={form}
				  onFinish={onFinish}
				  labelAlign="right"
				  labelCol={{ span: 8 }}
				  wrapperCol={{ span: 16 }}
				 
				>
				
				  <Form.Item name='title'  label='Title' rules={[{ required: true,message:'title is required'}]} >
					<Input  />
				  </Form.Item>
				
				   <Form.Item
						name='driver_id'
						label='Driver'
						rules={[
						  {
							required: true,
							message: 'select one driver',
						  },
						]}
					  >
					  
					  <Select>
						{driver.map((item)=>(
							<Select.Option value={item.id}>{item.fullname}</Select.Option>
						))
						}
						
					  </Select>
					  
					  
					</Form.Item>
					
					
					<Form.Item
						name="truck_id"
						label='Truck'
						rules={[
						  {
							required: true,
							message: 'select one truck',
						  },
						]}
					  >
					  
					  <Select>
						{truck.map((item)=>(
							<Select.Option value={item.id}>{item.title}</Select.Option>
						))
						}
						
					  </Select>
					  
					  
					</Form.Item>



				  <Form.Item  wrapperCol={{ offset: 8, span: 16 }}>
					<Button  type="primary" htmlType="submit"   >
					 send
					</Button>
				  </Form.Item>
				  
				</Form>
				</Col>
			</Row>

	
		
		</>
				
    );
  
}
