import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import {
  selectTruckIds,
  fetchTruck,
} from './TruckSlice'

import { message } from 'antd';

import Fun from '../../Fun'

export default function useTruck() {
  
  const dispatch = useDispatch();
  const ids = useSelector(selectTruckIds);
  
  const [messageApi, messageShow] = message.useMessage();
  
  const [searchStatus, setSearchStatus] = useState('idle');
  

  useEffect(async () => {

		  try {
			setSearchStatus('pending');
			// Fun.showShadow();
			// Fun.showLoader();
			const response=await dispatch(fetchTruck());
			
			// Fun.hideShadow();
			// Fun.hideLoader();
			
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
			}else{
				messageApi.open({
				  type: 'error',
				  content: 'There is no Truck',
				});
			}
			

		  } catch (err) {
			console.error('Failed to load data: ', err)
		  } finally {
			setSearchStatus('idle')
		  }
	}, [])
	
	
	return [messageShow,ids];
  
}
