import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';

import { Provider } from "react-redux";
import store from "./store";

import { CookiesProvider } from "react-cookie";

import { BrowserRouter } from "react-router-dom";

if (
  process.env.NODE_ENV === "development" &&  typeof makeServer === "function"
) {
	  window.SERVER_URL=window.Local_URL;		
  
}else{
	 window.SERVER_URL=window.Host_URL;	
} 

window.SERVER_URL=window.Host_URL;	


ReactDOM.render(
  <React.StrictMode>
   <Provider store={store}>
   <CookiesProvider>
   <BrowserRouter>
    <App />
	</BrowserRouter>
	</CookiesProvider>
	</Provider>
  </React.StrictMode>,
  document.getElementById('root')
);


