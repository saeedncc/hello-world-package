import React,{useState}  from "react";

import TripList from '../features/trip/TripList'


export default function TripWrap({title}){


	return (

	<div>
		<h1 style={style}>{title}</h1>
		
		<TripList/>
		
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


