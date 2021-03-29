// HashRouter:有#号
// BroserRouter:没有#号
// Switch:只要匹配到一个地址不往下匹配， 相当于for循环里面的break;
// Link:跳转页面
// exact:完全匹配路由
import React from 'react';
import {HashRouter as Router,Route,Switch} from 'react-router-dom';
// import{PrivateRoute} from './routers/private';
import asynComponents from './components/async/AsyncComponent';
//import config from './assets/js/conf/config.js';
const HomeComponent=asynComponents( ()=>import ('./pages/home/home/home'));

export default class RouterComponent extends React.Component{
    render(){
        return(
            <React.Fragment>
                <Router>
                    <React.Fragment>
                        <Switch>
                            <Route path="/" component={HomeComponent} ></Route>
                        </Switch>
                    </React.Fragment>
                </Router>
            </React.Fragment>
        )
    }
}