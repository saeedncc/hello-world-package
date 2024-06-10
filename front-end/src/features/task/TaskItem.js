import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import { client } from '../../api/client'

import {
	selectTaskById
} from '../task/TaskSlice'


import { Button, Space, Row } from 'antd';



export default function TaskItem({id,setIsModalOpen,setIdselect}){
	
	
  const item = useSelector((state) => selectTaskById(state, id))
  
  
  const showModal = () => {
    setIsModalOpen(true);
    setIdselect(id);
  };
  

  return (
  <>
	{item && 
	  <li style={style}>
		<Space direction='vertical' style={{width:'100%'}}>
				<Row justify="space-between" align="center"><span>{item.title}</span> <Button type="link" onClick={showModal}>Assign</Button></Row>
		 </Space>
	  </li>
	  }
	</>

  )
}


const style: React.CSSProperties = {
	
	marginBottom:10,
	borderBottom: '1px solid rgba(0, 0, 0, 0.5)', 

};




