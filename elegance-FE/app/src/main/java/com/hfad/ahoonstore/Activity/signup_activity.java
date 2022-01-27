package com.hfad.ahoonstore.Activity;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Bitmap;
import android.media.Image;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.hfad.ahoonstore.Helper;
import com.hfad.ahoonstore.R;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.util.HashMap;
import java.util.Map;

public class signup_activity extends AppCompatActivity {
    EditText username;
    EditText name;
    EditText password;
    EditText c_password;
    EditText email;
    EditText location;
    EditText phone_number;
    ImageView profImage;
    Button submit;
    Button selectImage;
    Bitmap myBit;
    RequestQueue myQueue;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);
        myQueue = Volley.newRequestQueue(this);
        username = (EditText)findViewById(R.id.sign_username);
        name = (EditText)findViewById(R.id.sign_name);
        password = (EditText)findViewById(R.id.sign_password);
        c_password = (EditText) findViewById(R.id.sign_c_password);
        email = (EditText) findViewById(R.id.sign_email);
        location = (EditText) findViewById(R.id.sign_location);
        phone_number = (EditText) findViewById(R.id.sign_phone_numb);
        submit = (Button) findViewById(R.id.signup_btn);
        selectImage = (Button)findViewById(R.id.pic_select_btn);
        profImage = (ImageView)findViewById(R.id.selImage);
        ActivityResultLauncher<Intent>  resLauncher = registerForActivityResult(
                new ActivityResultContracts.StartActivityForResult(),
                new ActivityResultCallback<ActivityResult>() {
                    @Override
                    public void onActivityResult(ActivityResult result) {
                        if(result.getResultCode() == RESULT_OK)
                        {
                            Uri ImageUri = result.getData().getData();
                            try {
                                myBit = MediaStore.Images.Media.getBitmap(getApplicationContext().getContentResolver(), ImageUri);
                                profImage.setImageBitmap(myBit);
                            } catch(Exception e) {
                                e.printStackTrace();
                            }
                        }
                    }
                }
        );
        selectImage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent profImageSelect = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
                resLauncher.launch(profImageSelect);
            }
        });
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HashMap<String, String> reqData = new HashMap<String, String>();
                reqData.put("username", username.getText().toString());
                reqData.put("name", name.getText().toString());
                reqData.put("email", email.getText().toString());
                reqData.put("password", password.getText().toString());
                reqData.put("c_password", c_password.getText().toString());
                reqData.put("Location", location.getText().toString());
                reqData.put("phone_number", phone_number.getText().toString());
                userSignUp(reqData);
            }
        });
    }
    public byte[] getFileDataFromDrawable(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 80, byteArrayOutputStream);
        return byteArrayOutputStream.toByteArray();
    }
    public void userSignUp(HashMap<String, String> data)
    {
          VolleyMultiPartRequest req = new VolleyMultiPartRequest(Request.Method.POST, Helper.createUser, new Response.Listener<NetworkResponse>() {
              @Override
              public void onResponse(NetworkResponse response) {
                  JSONObject obj = null;
                  try {
                      obj = new JSONObject(new String(response.data));
                  } catch (JSONException e) {
                      e.printStackTrace();
                  }
                  Toast.makeText(getApplicationContext(), "success", Toast.LENGTH_SHORT).show();
              }
              }, new Response.ErrorListener() {
              @Override
              public void onErrorResponse(VolleyError error) {
                  Toast.makeText(getApplicationContext(), "Error", Toast.LENGTH_SHORT).show();
              }
          }
          ) {
             @Override
              protected Map<String, String> getParams() throws AuthFailureError
              {
                  return data;
              }
              @Override
              protected Map<String, DataPart> getByteData()
              {
                  HashMap<String, DataPart> md = new HashMap<String, DataPart>();
                  long imageName = System.currentTimeMillis();
                  md.put("profilePics", new DataPart(imageName + ".png", getFileDataFromDrawable(myBit)));
                  return md;
              }
          };
        myQueue.add(req);
    }
}