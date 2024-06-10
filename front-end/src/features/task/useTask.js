import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import {
  selectTaskIds,
  fetchTask,
} from './TaskSlice'

import { message } from 'antd';

import Fun from '../../Fun'

export default function useTask() {
  
  const dispatch = useDispatch();
  const ids = useSelector(selectTaskIds);
  
  const [messageApi, messageShow] = message.useMessage();
  
  const [searchStatus, setSearchStatus] = useState('idle');
  

  useEffect(async () => {

		  try {
			setSearchStatus('pending');
			// Fun.showShadow();
			// Fun.showLoader();
			const response=await dispatch(fetchTask());
			
			// Fun.hideShadow();
			// Fun.hideLoader();
			
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
			}else{
				messageApi.open({
				  type: 'error',
				  content: 'There is no tasks',
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
