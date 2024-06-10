import { client } from '../../api/client'

import {
  createSlice,
  createAsyncThunk,
  createSelector,
  createEntityAdapter,
} from '@reduxjs/toolkit'


const tripAdapter = createEntityAdapter({
	selectId: (entity) => entity.id,
});

		  
const initialState = tripAdapter.getInitialState({
  status: 'idle',
  error: null,
})

export const fetchTrip = createAsyncThunk('trip/fetchTrip', async () => {
  return await client.send(window.SERVER_URL+'/trips');
})


export const createTrip = createAsyncThunk('trip/createTrip', async (params) => {
  return await client.send(window.SERVER_URL+'/trips','POST',params);
})


const tripSlice = createSlice({
  name: 'trip',
  initialState,
  reducers: {
	  
	tripSetTasks(state, action) {
		
	  const { id,tasks } = action.payload
      const item = state.entities[id]
      if (item) {
		  item.tasks=tasks;
      }
    },
	
	  
  },
  extraReducers: {
    [fetchTrip.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [fetchTrip.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
      tripAdapter.removeMany(state,state.ids);
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		tripAdapter.addMany(state, result);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [fetchTrip.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
	
	[createTrip.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [createTrip.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
      
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		tripAdapter.addOne(state, result);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [createTrip.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
  },
})

export const {tripSetTasks} = tripSlice.actions

export default tripSlice.reducer

export const {
  selectAll: selectAlltrip,
  selectById: selectTripById,
  selectIds: selectTripIds,
} = tripAdapter.getSelectors((state) => state.trip)


export const selectTripByName = createSelector(state=>state.trip, (state) =>{
	
	return state.ids.map((id)=>{
		
			return {id:state.entities[id].id,title:state.entities[id].title};
		})
	
});
