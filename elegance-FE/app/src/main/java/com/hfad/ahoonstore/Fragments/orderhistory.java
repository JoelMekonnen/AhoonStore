package com.hfad.ahoonstore.Fragments;
import android.os.Bundle;
import androidx.fragment.app.Fragment;
import androidx.viewpager2.widget.ViewPager2;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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
import com.google.android.material.tabs.TabLayout;
import com.hfad.ahoonstore.R;


public class orderhistory extends Fragment {
    TabLayout myLayout;
    ViewPager2 myPager;
    public orderhistory() {
        // Required empty public constructor
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        String[] textList = {"pending", "approved", "failed"};
        View myView = inflater.inflate(R.layout.fragment_orderhistory, container, false);
        myLayout = myView.findViewById(R.id.historyTab);
        myPager = myView.findViewById(R.id.tabPager);
        final getHistoryAdapter myAdapter = new getHistoryAdapter(this);
        myPager.setAdapter(myAdapter);
        new TabLayoutMediator(myLayout, myPager, (tab, position)-> {
                tab.setText(textList[position]);
        }).attach();


        return myView;
    }
}