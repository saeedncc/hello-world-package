import { client } from '../../api/client'

import {
  createSlice,
  createAsyncThunk,
  createSelector,
  createEntityAdapter,
} from '@reduxjs/toolkit'


const driverAdapter = createEntityAdapter({
	selectId: (entity) => entity.id,
});

		  
const initialState = driverAdapter.getInitialState({
  status: 'idle',
  error: null,
})

export const fetchDriver = createAsyncThunk('driver/fetchDriver', async () => {
  return await client.send(window.SERVER_URL+'/drivers');
})


const driverSlice = createSlice({
  name: 'driver',
  initialState,
  reducers: {
	  
	driverHide(state, action) {
		
	  const { id } = action.payload
      const item = state.entities[id]
      if (item) {
      }
    },
	
	  
  },
  extraReducers: {
    [fetchDriver.pending]: (state, action) => {
      state.status = 'loading'
	  state.error=null;
    },
    [fetchDriver.fulfilled]: (state, action) => {
      state.status = 'succeeded';
	  
      driverAdapter.removeMany(state,state.ids);
	  if(action.payload.state==1){
		  
		const result=action.payload.result;
		driverAdapter.addMany(state, result);
		
	  }else{
		 state.error = action.payload.result; 
	  }
    },
    [fetchDriver.rejected]: (state, action) => {
      state.status = 'failed'
      state.error = action.error.message
    },
	
  },
})

export const {driverHide} = driverSlice.actions

export default driverSlice.reducer

export const {
  selectAll: selectAlldriver,
  selectById: selectDriverById,
  selectIds: selectDriverIds,
} = driverAdapter.getSelectors((state) => state.driver)
