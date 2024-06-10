import React,{useState,useEffect} from 'react';

import TaskItem from './TaskItem'
import TaskForm from './TaskForm'
import useTask from './useTask'
import Modal from '../../components/Modal';

export default function TaskList() {
  
  const [messageShow,ids] = useTask();
  
  const [isModalOpen, setIsModalOpen] = useState(false);
  
  const [idselect, setIdselect] = useState(false);

    return (
	
		<>
		{messageShow}
			
		<ul style={style}>
			{ids.map((id)=>(
				<TaskItem key={'taks_'+id} id={id} setIsModalOpen={setIsModalOpen} setIdselect={setIdselect} />
			))
			}
		</ul>
		
		
		
		 <Modal title="Assign Task" open={isModalOpen} setIsModalOpen={setIsModalOpen} >
			<TaskForm idselect={idselect} setIsModalOpen={setIsModalOpen}/>
		 </Modal>
		
		</>
				
    );
  
}



const style: React.CSSProperties = {
  maxHeight:'calc(100vh - 40px)',
   paddingLeft:10,
  overflow:'auto'
};