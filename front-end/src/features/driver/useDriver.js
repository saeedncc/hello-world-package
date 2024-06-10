import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import {
  selectDriverIds,
  fetchDriver,
} from './DriverSlice'

import { message } from 'antd';

import Fun from '../../Fun'

export default function useDriver() {
  
  const dispatch = useDispatch();
  const ids = useSelector(selectDriverIds);
  
  const [messageApi, messageShow] = message.useMessage();
  
  const [searchStatus, setSearchStatus] = useState('idle');
  

  useEffect(async () => {

		  try {
			setSearchStatus('pending');
			Fun.showShadow();
			Fun.showLoader();
			const response=await dispatch(fetchDriver());
			
			Fun.hideShadow();
			Fun.hideLoader();
			
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
			}else{
				messageApi.open({
				  type: 'error',
				  content: 'There is no Drivers',
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
