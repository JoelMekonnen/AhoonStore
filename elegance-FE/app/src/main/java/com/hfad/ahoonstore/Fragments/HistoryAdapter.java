package com.hfad.ahoonstore.Fragments;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.hfad.ahoonstore.R;

import java.util.ArrayList;
import java.util.HashMap;

public class HistoryAdapter extends BaseAdapter {
    Activity act;
    ArrayList<HashMap<String, String>> orders;
    LayoutInflater inflate = null;
    HistoryAdapter(Activity act, ArrayList<HashMap<String, String>> obj)
    {
        this.act = act;
        this.orders= obj;
        inflate = (LayoutInflater)act.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }
    public int getCount() {
        return this.orders.size();
    }

    @Override
    public Object getItem(int position) {
        return orders.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (convertView == null)
        {
            convertView = LayoutInflater.from(act).inflate(R.layout.historystyle, parent, false);
        }
        HashMap<String, String> posItem = (HashMap<String, String>) getItem(position);
        TextView histProdName = (TextView) convertView.findViewById(R.id.histProdName);
        TextView histProdPrice = (TextView) convertView.findViewById(R.id.histProdPrice);
        TextView histOrderDate = (TextView) convertView.findViewById(R.id.histOrderDate);
        TextView histOrderStatus = (TextView) convertView.findViewById(R.id.histOrderStatus);
        histProdName.setText(posItem.get("prodName"));
        histProdPrice.setText(posItem.get("orderPrice"));
        histOrderDate.setText(posItem.get("orderDate"));
        histOrderStatus.setText(posItem.get("status"));

        return convertView;
    }
}
