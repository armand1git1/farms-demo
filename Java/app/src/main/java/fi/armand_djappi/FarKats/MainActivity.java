package fi.armand_djappi.FarKats;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.Response;

import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class MainActivity extends AppCompatActivity  {

    RequestQueue requestQueue;
    JsonArrayRequest myrequest;

    ListView yourListView;
    List<farms_data_strings> threeStringsList = new ArrayList<>();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getData(); // get data from api (farm list)


        yourListView = (ListView) findViewById(R.id.farms_list); // load listview adapter
        yourListView.setTextFilterEnabled(true);
        yourListView.setFocusable(true);

    }

    public void getData() {

        //todo : connect to localhost and retrive datat and
        // local api
        //String url = "http://192.168.1.167:8080/v1/farms";
        // remote Api
        String url = "http://84.249.7.85/v1/farms";
        JsonArrayRequest jsonArrayRequest=null;

        // volley library to used our api
        requestQueue = Volley.newRequestQueue(getApplicationContext());

        //todo improv function or move on
        try {
             jsonArrayRequest  = new JsonArrayRequest
                    (Request.Method.GET,
                            url,
                            null,
                            new Response.Listener<JSONArray>() {
                                @Override
                                public void onResponse(JSONArray jsonarray) {
                                   try {

                                        for(int i = 0; i < jsonarray.length(); i++) {
                                            JSONObject jsonobject = jsonarray.getJSONObject(i);

                                            String name = jsonobject.getString("name");
                                            String location = jsonobject.getString("location");
                                            farms_data_strings threeStrings = new farms_data_strings(name, location, "cal/3,5/2");
                                            threeStringsList.add(threeStrings);
                                        }
                                        farms_data_adapter customAdapter = new farms_data_adapter(getApplicationContext(), R.layout.farms_list_tools, threeStringsList);
                                        yourListView.setAdapter(customAdapter);
                                    } catch (JSONException ex) {
                                        ex.printStackTrace();
                                    }
                                }
        }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), (error).toString(), Toast.LENGTH_LONG).show();
                        }
                    });
            requestQueue.add(jsonArrayRequest);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}