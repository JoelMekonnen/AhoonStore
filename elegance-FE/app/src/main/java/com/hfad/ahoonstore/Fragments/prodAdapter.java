package com.hfad.ahoonstore.Fragments;
import android.app.Activity;
import android.app.Fragment;
import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;


import android.app.Fragment;

import androidx.fragment.app.FragmentActivity;
import androidx.fragment.app.FragmentManager;

import com.hfad.ahoonstore.Helper;
import com.hfad.ahoonstore.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.HashMap;


public class prodAdapter extends BaseAdapter {
    Activity activity;
    ArrayList<HashMap<String, String>> prods;
    LayoutInflater layoutInflater = null;

    public prodAdapter(Activity act, ArrayList<HashMap<String, String>> obj)
    {
        this.activity = act;
        this.prods = obj;
        layoutInflater = (LayoutInflater)activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }
    @Override
    public int getCount() {
           return prods.size();
    }

    @Override
    public Object getItem(int i) {
         return prods.get(i);
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
          if (view == null)
          {
              view = LayoutInflater.from(activity).inflate(R.layout.prods, viewGroup, false);
          }
          HashMap<String, String> pos = (HashMap<String, String>) getItem(i);
          TextView productName = (TextView) view.findViewById(R.id.productName);
          TextView productDesc = (TextView) view.findViewById(R.id.productDesc);
          TextView price = (TextView)view.findViewById(R.id.price);
          ImageView prodImage = (ImageView)view.findViewById(R.id.prodImage);
          Button  orderProd = (Button)view.findViewById(R.id.orderProd);
          productName.setText(pos.get("productName"));
          productDesc.setText(pos.get("productDesc"));
          price.setText(pos.get("price"));
          String imgUrl = Helper.ip + "/storage/product/" + pos.get("prodImage");
          Picasso.get().load(imgUrl).into(prodImage);

          orderProd.setOnClickListener(new View.OnClickListener() {
              @Override
              public void onClick(View view) {
                  FragmentActivity act = (FragmentActivity)activity;
                  FragmentManager manager = act.getSupportFragmentManager();
                  createOrder newOrder = new createOrder();
                  Bundle data = new Bundle();
                  data.putString("productName", pos.get("productName"));
                  data.putString("productDesc", pos.get("productDesc"));
                  data.putString("price", pos.get("price"));
                  data.putString("prod_id", pos.get("id"));
                  data.putString("prodImage", pos.get("prodImage"));
                  newOrder.setArguments(data);
                  manager.beginTransaction().replace(R.id.contentContainer, newOrder).addToBackStack(null).commit();
              }
          });

          
          return view;
    }
}
