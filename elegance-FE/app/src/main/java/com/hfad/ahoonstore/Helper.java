package com.hfad.ahoonstore;

import java.util.HashMap;

public class Helper {
    public static String rootUrl = "http://192.168.8.156:8000/api";
    public static String ip = "http://192.168.8.156:8000";
    public static String loginUrl = "http://192.168.8.156:8000/oauth/token";
    public static String getProducts = rootUrl + "/products";
    public static String getUser = rootUrl + "/user/get";
    public static String createOrder = rootUrl + "/order/create";
    public static String logout = rootUrl + "/logout";
    public static String pending= rootUrl + "/user/order/pending";
    public static String createUser = rootUrl + "/user/create/";
    public static String approved = rootUrl + "/user/order/approved";
    public static String failed = rootUrl + "/user/order/failed";
}
