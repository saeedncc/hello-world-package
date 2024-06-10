import React, { useState ,useEffect, useRef, useCallback, Profiler } from "react";
import { hot } from "react-hot-loader/root";

import {  Row, Col } from 'antd';

import './App.css';

import TaskWrap from './components/TaskWrap'
import TripWrap from './components/TripWrap'


function App() {
	
  return (
	
		
		<Row>
		
			<Col           
				key='col-1'
				xs={24}  md={6} 
			>
			
			<TaskWrap title='tasks' />
  
			</Col>
			
			<Col           
				key='col-2'
				xs={24}  md={18} 
			>
  
				<TripWrap title='trips' />
			</Col>
		
		
		</Row>


  );
}





export default hot(App);








