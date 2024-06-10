import { client } from '../../api/client'

import {
  createSlice,
  createAsyncThunk,
  createSelector,
  createEntityAdapter,
} from '@reduxjs/toolkit'


const truckAdapter = createEntityAdapter({
	selectId: (entity) => entity.id,
});

		  
const initialState = truckAdapter.getInitialState({
  status: 'idle',
  error: null,
})

export const fetchTruck = createAsyncThunk('truck/fetchTruck', async () => {
  return await client.send(window.SERVER_URL+'/trucks');
})


const truckSlice = createSlice({
  name: 'truck',
  initialState,
  reducers: {
	  
	truckHide(state, action) {
		
	  const { id } = action.payload
      const item = state.entities[id]
      if (item) {
      }
    },
	
	  
  },
  extraReducers: {
    [fetchTruck.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [fetchTruck.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
      truckAdapter.removeMany(state,state.ids);
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		truckAdapter.addMany(state, result);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [fetchTruck.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
  },
})

export const {truckHide} = truckSlice.actions

export default truckSlice.reducer

export const {
  selectAll: selectAlltruck,
  selectById: selectTruckById,
  selectIds: selectTruckIds,
} = truckAdapter.getSelectors((state) => state.truck)