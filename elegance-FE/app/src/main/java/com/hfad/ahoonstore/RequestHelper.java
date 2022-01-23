package com.hfad.ahoonstore;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class RequestHelper {
    private String url;
    public String resTemp;
    private JSONObject result = new JSONObject();

    RequestHelper(String url)
    {
        this.url = url;
    }
    public String getUrl() {
        return url;
    }
    public void setUrl(String url) {
        this.url = url;
    }
//    public JSONObject getResult()
//    {
//        return this.result;
//    }
    public void setResult(JSONObject newResult) throws JSONException {
        result = newResult;
    }
}
