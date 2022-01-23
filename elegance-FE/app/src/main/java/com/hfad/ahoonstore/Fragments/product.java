package com.hfad.ahoonstore.Fragments;

import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.hfad.ahoonstore.Helper;
import com.hfad.ahoonstore.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class product extends Fragment {
   private ListView mainList;
   ArrayList<HashMap<String, String>> prodList;
   RequestQueue myQueue;
   JSONObject prodResult;
   SharedPreferences myPref;
   ListView prodListView;
    public product() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        myQueue= Volley.newRequestQueue(this.getActivity());
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View prodView = inflater.inflate(R.layout.fragment_product, container, false);
        myPref = this.getActivity().getSharedPreferences("mainPref", 0);
        prodList = new ArrayList<>();
        prodListView = prodView.findViewById(R.id.prodList);
        mainList = (ListView) prodView.findViewById(R.id.prodList);
        HashMap<String, String> token = new HashMap<String, String>();
        token.put("Authorization", "Bearer " + myPref.getString("Token", "None"));
        try {
            JsonObjectRequest makeRequest = new JsonObjectRequest(Request.Method.GET, Helper.getProducts, null,
                    new Response.Listener<JSONObject>() {
                        @Override
                        public void onResponse(JSONObject response) {
                            prodResult = response;
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
        } catch(Exception e) {
            e.printStackTrace();
        }
        return prodView;
    }
    public void setMainView(JSONObject res) {
        if(res != null)
        {
            try {
                JSONArray prods = res.getJSONArray("data");
                for (int i = 0; i < prods.length(); i++)
                {
                    JSONObject resJson = prods.getJSONObject(i);
                    String prodID = resJson.getString("id");
                    String prodName = resJson.getString("productName");
                    String prodDesc = resJson.getString("productDesc");
                    String prodImage = resJson.getString("prodImage");
                    String price = resJson.getString("price");

                    HashMap<String, String> prod = new HashMap<String, String>();
                    prod.put("id", prodID);
                    prod.put("productName", prodName);
                    prod.put("productDesc", prodDesc);
                    prod.put("prodImage", prodImage);
                    prod.put("price", price);

                    prodList.add(prod);
                }
            } catch(Exception e)
            {
                e.printStackTrace();
            }
        }
        ListAdapter adapter = new prodAdapter(getActivity(), prodList);
        prodListView.setAdapter(adapter);
    }
}