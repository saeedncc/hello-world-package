import React,{useState}  from "react";

import TaskList from '../features/task/TaskList'

export default function TaskWrap({title}){


	return (

	<div>
		<h1 style={style}>{title}</h1>
		
		<TaskList/>
		
	</div>

	);
}




const style: React.CSSProperties = {
  textAlign: 'left',
  color: '#fff',
  backgroundColor: '#0958d9',
  fontSize:20,
  paddingLeft:10,
  height:40
};
