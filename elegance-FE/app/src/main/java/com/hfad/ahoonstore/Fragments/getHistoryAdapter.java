package com.hfad.ahoonstore.Fragments;
import android.content.Context;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.lifecycle.Lifecycle;
import androidx.viewpager2.adapter.FragmentStateAdapter;


public class getHistoryAdapter extends FragmentStateAdapter {


    public getHistoryAdapter(@NonNull Fragment fragment) {
        super(fragment);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        switch(position) {
            case 0:
                Bundle data = new Bundle();
                data.putString("pagerID", "pending");
                historyFragment histFrag = new historyFragment();
                histFrag.setArguments(data);
                return histFrag;
            case 1:
                Bundle data1 = new Bundle();
                data1.putString("pagerID", "approved");
                historyFragment histFrag1 = new historyFragment();
                histFrag1.setArguments(data1);
                return histFrag1;
            case 2:
                Bundle data2 = new Bundle();
                data2.putString("pagerID", "failed");
                historyFragment histFrag2 = new historyFragment();
                histFrag2.setArguments(data2);
                return histFrag2;
            default:
                return null;
        }
    }

    @Override
    public int getItemCount() {
        return 3;
    }
}
