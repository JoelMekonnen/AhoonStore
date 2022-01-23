package com.hfad.ahoonstore.Fragments;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.fragment.app.FragmentManager;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.google.android.material.snackbar.Snackbar;
import com.hfad.ahoonstore.Helper;
import com.hfad.ahoonstore.R;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;


public class createOrder extends Fragment {
    private String productName;
    private String productDesc;
    private String price;
    private String prod_id;
    private String prodImage;
    TextView prodName;
    TextView prodDesc;
    TextView prodPrice;
    Button orderBtn;
    ImageView prod_Image;
    EditText Quantity;
    EditText city;
    EditText sub_city;
    EditText houseNo;
    RequestQueue mQueue;
    SharedPreferences myPref;
    public createOrder() {
        // Required empty public constructor
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @SuppressLint("WrongConstant")
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View myView = inflater.inflate(R.layout.fragment_create_order, container, false);
        mQueue = Volley.newRequestQueue(getActivity());
        myPref = getActivity().getSharedPreferences("mainPref", Context.MODE_APPEND);
        Bundle bundle = getArguments();
        productName = bundle.getString("productName");
        productDesc = bundle.getString("productDesc");
        price = bundle.getString("price");
        prod_id = bundle.getString("prod_id");
        prodImage = bundle.getString("prodImage");
        String imgUrl = Helper.ip + "/storage/product/" + prodImage;
        prodName =(TextView) myView.findViewById(R.id.prodName);
        prodDesc = (TextView) myView.findViewById(R.id.prodDesc);
        prodPrice = (TextView)myView.findViewById(R.id.prodPrice);
        Button orderBtn = (Button)myView.findViewById(R.id.createOrderBtn);
        prod_Image = (ImageView)myView.findViewById(R.id.headerImage);
        Quantity = (EditText)myView.findViewById(R.id.quantity);
        city = (EditText)myView.findViewById(R.id.city);
        sub_city = (EditText)myView.findViewById(R.id.subcity);
        houseNo = (EditText)myView.findViewById(R.id.houseNo);
        Picasso.get().load(imgUrl).into(prod_Image);
        prodName.setText(productName);
        prodDesc.setText(productDesc);
        prodPrice.setText(price);
        HashMap<String, String> sendData = new HashMap<String, String>();
        String Token = myPref.getString("Token", "");
        String profile_id = myPref.getString("profile_id", "");
        System.out.println(profile_id);
        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                sendData.put("user_id", myPref.getString("profile_id", ""));
                sendData.put("prod_id", prod_id);
                sendData.put("quantity", Quantity.getText().toString());
                sendData.put("city", city.getText().toString());
                sendData.put("sub-city", sub_city.getText().toString());
                sendData.put("house-no", houseNo.getText().toString());
                System.out.println(new JSONObject(sendData));
               StringRequest newReq = new StringRequest(
                       Request.Method.POST,
                       Helper.createOrder,
                       new Response.Listener<String>() {
                           @Override
                           public void onResponse(String response) {
                               FragmentActivity act = (FragmentActivity)getActivity();
                               FragmentManager manager = act.getSupportFragmentManager();
                               product prods = new product();
                                 int respIndex=  response.indexOf("response:");
                                 Toast.makeText(getActivity(), "Order Successfully created" ,Toast.LENGTH_LONG).show();
                                 manager.beginTransaction().replace(R.id.contentContainer, prods).commit();

                           }
                       },
                       new Response.ErrorListener() {
                           @Override
                           public void onErrorResponse(VolleyError error) {
                               System.out.println(error.toString());
                               Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_SHORT).show();
                           }
                       }
               ){
                   @Override
                   public Map<String, String> getHeaders() throws AuthFailureError {
                       HashMap<String, String> myHeaders = new HashMap<String, String>();
                       myHeaders.put("Authorization", "Bearer " + Token);
                       myHeaders.put("Content-Type", "application/json");
                       return myHeaders;
                   }
                   @Override
                   public byte[] getBody() {
                       return new JSONObject(sendData).toString().getBytes();
                   }
               };
               mQueue.add(newReq);
            }
        });

        return myView;
    }
}