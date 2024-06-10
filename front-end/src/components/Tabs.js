import React, {useState} from "react";

import { Tabs as Tb } from 'antd';
import type { TabsProps } from 'antd';

export default function Tabs({items}){
	
	return (
	
		<Tb defaultActiveKey="1" items={items} />
		

	);
}

