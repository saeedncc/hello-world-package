import React,{useState,useEffect} from 'react';

import TripItem from './TripItem'
import TripForm from './TripForm'
import useTrip from './useTrip'
import useTruck from '../truck/useTruck'
import useDriver from '../driver/useDriver'
import Modal from '../../components/Modal';
import Tabs from '../../components/Tabs';

import {Button } from 'antd';

export default function TripList() {
  
  const [messageShow,ids,titles] = useTrip();
   useTruck();
   useDriver();
  
  const [isModalOpen, setIsModalOpen] = useState(false);
  
  	const items= titles.map((item)=>{
		return 	  {
		key: item.id,
		label: item.title,
		children: (<TripItem key={'trip_'+item.id} id={item.id} />),
	  };
	})



    return (
	
		<div style={{paddingLeft:10}}>
		{messageShow}
		
		<div style={{textAlign:'right',marginRight:10,marginTop:10}}><Button type="primary" danger onClick={()=>{setIsModalOpen(true);}}>Add</Button></div>
		
		<Tabs items={items} />
		
		 <Modal title="Create Trip" open={isModalOpen} setIsModalOpen={setIsModalOpen} >
			<TripForm  setIsModalOpen={setIsModalOpen} />
		 </Modal>
		
		</div>
				
    );
  
}



const style: React.CSSProperties = {
  maxHeight:'calc(100vh - 40px)',
   paddingLeft:10,
  overflow:'auto'
};