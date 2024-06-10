import React, {useState} from "react";

import { Modal as ML } from 'antd';

export default function Modal({title,open,setIsModalOpen,children}){

  const handleOk = () => {
    setIsModalOpen(false);
  };

  const handleCancel = () => {
    setIsModalOpen(false);
  };  
	
	return (
	
	<ML title={title} open={open} onOk={handleOk} onCancel={handleCancel} footer={null}>
	
		{children}

    </ML>
		

	);
}

