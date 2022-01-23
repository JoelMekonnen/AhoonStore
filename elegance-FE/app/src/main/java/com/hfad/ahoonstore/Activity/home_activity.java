package com.hfad.ahoonstore.Activity;
import androidx.appcompat.app.AppCompatActivity;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.view.MenuItem;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.navigation.NavigationView;
import org.jetbrains.annotations.NotNull;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.HashMap;
import java.util.Map;

import com.hfad.ahoonstore.Fragments.logout;
import com.hfad.ahoonstore.Fragments.orderhistory;
import com.hfad.ahoonstore.Fragments.posts;
import com.hfad.ahoonstore.Fragments.product;
import com.hfad.ahoonstore.Fragments.profile;
import com.hfad.ahoonstore.Helper;
import com.hfad.ahoonstore.R;
import com.squareup.picasso.Picasso;

public class home_activity extends AppCompatActivity {
    public DrawerLayout mydrawer;
    public ActionBarDrawerToggle myToggler;
    TextView headerText;
    ImageView profImage;
    private SharedPreferences pref;
    RequestQueue myQueue;
    @SuppressLint("WrongConstant")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        mydrawer = findViewById(R.id.drawer_layout);
        myToggler = new ActionBarDrawerToggle(this, mydrawer, R.string.nav_open, R.string.nav_close);
        mydrawer.addDrawerListener(myToggler);
        myToggler.syncState();
        InitVals();
        Toolbar myToolbar = (Toolbar)findViewById(R.id.toolbar);
        myToolbar.setNavigationIcon(R.drawable.ic_bars);
        setSupportActionBar(myToolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        NavigationView myNav = (NavigationView) findViewById(R.id.myNav);
        setNavigation(myNav);
        if(savedInstanceState == null) {
            getSupportFragmentManager().beginTransaction().replace(R.id.contentContainer, new product()).commit();
        }
    }
    @SuppressLint("WrongConstant")
    public void InitVals()
    {
        pref = home_activity.this.getSharedPreferences("mainPref", Context.MODE_APPEND);
        String token = pref.getString("Token", "");
        HashMap<String, String> reqHeader = new HashMap<String, String>();
        reqHeader.put("Authorization", "Bearer " + token);
        JSONObject mj = new JSONObject();
        myQueue = Volley.newRequestQueue(this);
        JsonObjectRequest myReq = new JsonObjectRequest(
                Request.Method.GET,
                Helper.getUser,
                null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            SharedPreferences.Editor myEdit = pref.edit();
                            JSONObject data = response.getJSONObject("data");
                            JSONObject profile = data.getJSONObject("profile");
                            JSONObject user_data = data.getJSONObject("user");
                            headerText = (TextView)findViewById(R.id.navText);
                            profImage = (ImageView)findViewById(R.id.profImage);
                            String imgUrl = Helper.ip + "/storage/profilePics/" + profile.getString("profile_pic");
                            Picasso.get().load(imgUrl).into(profImage);
                            headerText.setText(user_data.getString("name"));
                            myEdit.putString("profile_id", profile.getString("id"));
                            myEdit.apply();
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(home_activity.this, error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        ) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                return reqHeader;
            }
        };
       myQueue.add(myReq);
    }
    public void setNavigation(NavigationView nav)
    {
        nav.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull @NotNull MenuItem item) {
                setContent(item);
                return true;
            }
        });
    }
    public void setContent(MenuItem Item)
    {
         Fragment fragment = null;
         Class fragmentClass;
         switch(Item.getItemId())
         {
             case R.id.nav_order_history:
                 fragmentClass = orderhistory.class;
                 break;
             case R.id.nav_products:
                 fragmentClass = product.class;
                 break;
             case R.id.nav_posts:
                 fragmentClass = posts.class;
                 break;
             case R.id.nav_profile:
                 fragmentClass = profile.class;
                 break;
             case R.id.nav_logout:
                 fragmentClass = logout.class;
                 break;
             default:
                 fragmentClass = product.class;
         }
         try {
             fragment = (Fragment) fragmentClass.newInstance();
         } catch (Exception e) {
             e.printStackTrace();
         }
         FragmentManager frag  = getSupportFragmentManager();
         frag.beginTransaction().replace(R.id.contentContainer, fragment).addToBackStack(null).commit();
//         Item.setChecked(!Item.isChecked());
    }
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        if(myToggler.onOptionsItemSelected(item)){
            return true;
        }
        if (getFragmentManager().getBackStackEntryCount() != 0) {
            getFragmentManager().popBackStack();
        }
        return super.onOptionsItemSelected(item);
    }
}