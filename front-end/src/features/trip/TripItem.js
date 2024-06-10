import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import { client } from '../../api/client'

import {
	selectTripById
} from './TripSlice'


import { Button, Space, Row, Col, Tag  } from 'antd';



export default function TripItem({id}){
	
  const item = useSelector((state) => selectTripById(state, id));
  
  const tasks =item.tasks ? item.tasks.split(',') : [];
  

  return (
	<>
		{item && 

	
			
			  <Row justify="center" style={style}>
					<Col span={8}>Title</Col> <Col span={16}>{item.title}</Col> 
					<Col span={8}>Driver</Col> <Col span={16}>{item.driver_fullname}</Col> 
					<Col span={8}>Truck</Col> <Col span={16}>{item.truck_title}</Col> 
				
					<Col span={8}>Tasks</Col> 
					<Col span={16}>		
					{tasks.map((task)=>(
						
						<Tag>{task}</Tag>
					))
					
					}
					
					</Col>
					
			</Row>
				


	  }
	</>

  )
}


const style: React.CSSProperties = {
	
	marginBottom:20,
	width:'100%'

};




