import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import { Button, Checkbox, Form, Input,Col, Row, message, Select } from 'antd';

import Fun from '../../Fun'

import {
  assignTask,
} from './TaskSlice'

import {
   tripSetTasks,
  selectTripByName,
} from '../trip/TripSlice'


export default function TaskForm({setIsModalOpen,idselect}) {
	
	const dispatch = useDispatch();
	const trip=useSelector(selectTripByName);
	
	const [form] = Form.useForm();
	
	const [searchStatus, setSearchStatus] = useState('idle');
	
	const [messageApi, messageShow] = message.useMessage();
	
	
	const onReset = () => {
		form.resetFields();
	};
  
  	const onFinish=async (values: any)=>{
		 
		 
		 if(searchStatus=='pending') return false;
		 
		 const {trip_id}=values;
		 
		 try {
			setSearchStatus('pending');
			
			const params={id:idselect,trip_id:trip_id};
			
			Fun.showShadow();
			Fun.showLoader();
			const response=await dispatch(assignTask(params));
						
			Fun.hideShadow();
			Fun.hideLoader();
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
				
				let tasks=response.payload.result.tasks.map((item)=>{
					return item.title;
				})
				
				tasks=tasks.join(',');
				
				dispatch(tripSetTasks({id:response.payload.result.trip_id,tasks:tasks}));
				
				onReset();
				setIsModalOpen(false);
				
				messageApi.success('task is assigned');

			}else{
				messageApi.error('task is not assigned');
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
				  name="task"
				  form={form}
				  onFinish={onFinish}
				  labelAlign="right"
				  labelCol={{ span: 8 }}
				  wrapperCol={{ span: 16 }}
				 
				>
				
				   <Form.Item
						name='trip_id'
						label='Trip'
						rules={[
						  {
							required: true,
							message: 'select one trip',
						  },
						]}
					  >
					  
					  <Select>
						{trip.map((item)=>(
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
