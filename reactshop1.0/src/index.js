/*eslint-disable*/
import 'babel-polyfill';
import 'url-search-params-polyfill';
import React from 'react';
import ReactDOM from 'react-dom';
import RouterComponent from './router';
//import reportWebVitals from './reportWebVitals';
//import "./assets/js/libs/zepto.js";
import * as serviceWorker from './serviceWorker';
import "./assets/css/common/public.css";

ReactDOM.render(<RouterComponent />, document.getElementById('root'));

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
//reportWebVitals();
serviceWorker.unregister();
