import { client } from '../../api/client'

import {
  createSlice,
  createAsyncThunk,
  createSelector,
  createEntityAdapter,
} from '@reduxjs/toolkit'


const taskAdapter = createEntityAdapter({
	selectId: (entity) => entity.id,
});

		  
const initialState = taskAdapter.getInitialState({
  status: 'idle',
  error: null,
})

export const fetchTask = createAsyncThunk('task/fetchTask', async () => {
  return await client.send(window.SERVER_URL+'/tasks');
})

export const assignTask = createAsyncThunk('trip/assignTask', async (params) => {
	const id=params['id'];
	
	delete params['id'];
	
  return await client.send(window.SERVER_URL+'/tasks/'+id+'/assign','PUT',params);
})


const taskSlice = createSlice({
  name: 'task',
  initialState,
  reducers: {
	  
	taskHide(state, action) {
		
	  const { id } = action.payload
      const item = state.entities[id]
      if (item) {
      }
    },
	
	  
  },
  extraReducers: {
    [fetchTask.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [fetchTask.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
      taskAdapter.removeMany(state,state.ids);
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		taskAdapter.addMany(state, result);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [fetchTask.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
	[assignTask.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [assignTask.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		taskAdapter.removeOne(state, result.id);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [assignTask.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
  },
})

export const {taskHide} = taskSlice.actions

export default taskSlice.reducer

export const {
  selectAll: selectAlltask,
  selectById: selectTaskById,
  selectIds: selectTaskIds,
} = taskAdapter.getSelectors((state) => state.task)


export const selectTaskByName = createSelector(state=>state.task, (state) =>{
	
	return state.ids.map((id)=>{
		
			return {id:state.entities[id].id,title:state.entities[id].title};
		})
	
});
