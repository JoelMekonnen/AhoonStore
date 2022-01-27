package com.hfad.ahoonstore.Fragments;

import android.content.Context;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.google.android.material.tabs.TabLayoutMediator;
import com.hfad.ahoonstore.Helper;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonObjectRequest;
import org.json.JSONArray;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.hfad.ahoonstore.R;
public class historyFragment extends Fragment {
    SharedPreferences myPref;
    RequestQueue  myQueue;
    ArrayList<HashMap<String, String>> orderList = new ArrayList<HashMap<String, String>>();
    ListView orderListView;
    HashMap<String, String> token = new HashMap<String, String>();
    public historyFragment() {
        // Required empty public constructor
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        myPref = getActivity().getSharedPreferences("mainPref", Context.MODE_PRIVATE);
        myQueue = Volley.newRequestQueue(getActivity());
        token.put("Authorization", "Bearer " + myPref.getString("Token", "None"));
        // Inflate the layout for this fragment
        View myView  = inflater.inflate(R.layout.fragment_history, container, false);
        orderListView = myView.findViewById(R.id.historyList);
        if(getArguments() != null)
        {
            String tabString = getArguments().getString("pagerID");
            if(tabString.equals("approved"))
            {
                getApprovedHistory();
            } else if (tabString.equals("failed")) {
                getFailedHistory();
            } else if(tabString.equals("pending")) {
                getPendingHistory();
            }
        }
        return myView;
    }
    public  void getApprovedHistory()
    {
        JsonObjectRequest makeRequest = new JsonObjectRequest(Request.Method.GET, Helper.approved, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                          setMainView(response);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                return token;
            }
        };
        myQueue.add(makeRequest);
    }
    public void getFailedHistory()
    {
        JsonObjectRequest makeRequest = new JsonObjectRequest(Request.Method.GET, Helper.failed, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        setMainView(response);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                return token;
            }
        };
        myQueue.add(makeRequest);
    }
    public void getPendingHistory()
    {
        JsonObjectRequest makeRequest = new JsonObjectRequest(Request.Method.GET, Helper.pending, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        setMainView(response);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                return token;
            }
        };
        myQueue.add(makeRequest);
    }
    public void setMainView(JSONObject res) {
        if(res != null)
        {
            try {
                JSONArray orders = res.getJSONArray("data");
                for (int i = 0; i < orders.length(); i++)
                {
                    JSONObject resJson = orders.getJSONObject(i);
                    JSONObject order_product = resJson.getJSONObject("product");
                    String product_name = order_product.getString("productName");
                    String order_price = resJson.getString("total");
                    String order_date = resJson.getString("created_at");
                    String order_status = resJson.getString("status");
                    HashMap<String, String> showList = new HashMap<String, String>();
                    showList.put("prodName", product_name);
                    showList.put("orderPrice", order_price);
                    showList.put("orderDate", order_date);
                    showList.put("status", order_status);
                    orderList.add(showList);
                }
            } catch(Exception e)
            {
                e.printStackTrace();
            }
        }
        ListAdapter adapter = new HistoryAdapter(getActivity(), orderList);
        orderListView.setAdapter(adapter);
    }
}