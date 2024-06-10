import React,{useState,useEffect} from 'react';
import { useSelector, useDispatch } from 'react-redux'

import {
  selectTripIds,
  selectTripByName,
  fetchTrip,
} from './TripSlice'

import { message } from 'antd';

import Fun from '../../Fun'

export default function useTrip() {
  
  const dispatch = useDispatch();
  const ids = useSelector(selectTripIds);
  const titles = useSelector(selectTripByName);
  
  const [messageApi, messageShow] = message.useMessage();
  
  const [searchStatus, setSearchStatus] = useState('idle');
  

  useEffect(async () => {

		  try {
			setSearchStatus('pending');
			// Fun.showShadow();
			// Fun.showLoader();
			
			const response=await dispatch(fetchTrip());
			
			// Fun.hideShadow();
			// Fun.hideLoader();
			
			
			if(typeof response!='undefined' && response?.payload?.state==1){
				
			}else{
				messageApi.open({
				  type: 'error',
				  content: 'There is no trip',
				});
			}
			

		  } catch (err) {
			console.error('Failed to load data: ', err)
		  } finally {
			setSearchStatus('idle')
		  }
	}, [])
	
	
	return [messageShow,ids,titles];


  
}
