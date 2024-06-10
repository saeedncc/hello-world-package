import { configureStore } from '@reduxjs/toolkit'

import tripReducer from './features/trip/TripSlice'
import taskReducer from './features/task/TaskSlice'
import truckReducer from './features/truck/TruckSlice'
import driverReducer from './features/driver/DriverSlice'


export default configureStore({
  reducer: {
	trip:tripReducer,
	task:taskReducer,
	truck:truckReducer,
	driver:driverReducer,
  },
})
