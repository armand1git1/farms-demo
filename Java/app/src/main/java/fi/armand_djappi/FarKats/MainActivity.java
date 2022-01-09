package fi.armand_djappi.FarKats;

import androidx.appcompat.app.AppCompatActivity;

import android.net.DnsResolver;
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
import java.util.Arrays;
import java.util.List;

//import okhttp3.Response;


public class MainActivity extends AppCompatActivity  {

    RequestQueue requestQueue;
    JsonArrayRequest myrequest;

    ListView yourListView;
    List<farms_data_strings> threeStringsList = new ArrayList<>();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //RequestQueue For Handle Network Request
        //RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());

        /*
        myrequest= getData();
        myrequest.getBodyContentType();
        System.out.println(myrequest.toString());
        //requestQueue.toString(0).charAt("name");
        */

        // creating an Empty Integer List
        //List<farms_data_strings> threeStringsList = new ArrayList<>();
        //farms_data_strings threeStrings = new farms_data_strings("djappi farm", "Tampere", "cal/3,5/2");
        getData();
        //threeStringsList.add(threeStrings);
        //System.out.println(Arrays.toString(threeStringsList));
        System.out.println(Arrays.deepToString(threeStringsList.toArray()));



        //ListView yourListView = (ListView) findViewById(R.id.farms_list);

       // get data from the table by the ListAdapter

        yourListView = (ListView) findViewById(R.id.farms_list);
        //ListAdapter customAdapter = new ListAdapter(this, R.layout.farms_list_tools, List<yourItem>);
        //farms_data_adapter customAdapter = new farms_data_adapter(this, R.layout.farms_list_tools, threeStringsList);
        //farms_data_adapter customAdapter = new farms_data_adapter(getApplicationContext(), R.layout.farms_list_tools, threeStringsList);
        //yourListView.setAdapter(customAdapter);
        //yourListView.setAdapter(customAdapter);

        yourListView.setTextFilterEnabled(true);
        //listView.setAdapter(adapter);
        yourListView.setFocusable(true);

    }

    public void getData() {
        //String url = "http://localhost:8080/v1/farms";
        //String url = "http://localhost:8000/v1/farms";
        //String url = "http://localhost/v1/farms";
        //String url = "https://corona.lmao.ninja/v2/all/";


        //String url = "http://10.0.2.2:8080/v1/farms";
        //String url = "http://10.0.2.2/v1/farms";
        //String url = "192.168.1.167:8080/v1/farms";
        //todo : connect to localhost and retrive datat and
        String url = "http://192.168.1.167:8080/v1/farms";

        //String url = "192.168.1.167/localhost:8080/v1/farms";
        //String url = "192.168.1.167/v1/farms";
        //String url = "192.168.1.1:8080/v1/farms";
        JsonArrayRequest jsonArrayRequest=null;


        requestQueue = Volley.newRequestQueue(getApplicationContext());

        //todo improv function or move on
        try {
             //final JSONObject object = new JSONObject();
            //final JSONArray jsonarray = new JSONArray();

            //JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
             jsonArrayRequest  = new JsonArrayRequest
                    (Request.Method.GET,
                            url,
                            null,
                            new Response.Listener<JSONArray>() {
                                @Override
                                //public void onResponse(JSONObject response) {
                                public void onResponse(JSONArray jsonarray) {
                                    //textView.setText("Response: " + response.toString());
                                    //Toast.makeText(getApplicationContext(), "I am OK !" + response.toString(), Toast.LENGTH_LONG).show();
                                    //System.out.println(Arrays.toString(JSONArray));
                                    try {

                                        for(int i = 0; i < jsonarray.length(); i++) {
                                            JSONObject jsonobject = jsonarray.getJSONObject(i);

                                            String name = jsonobject.getString("name");
                                            String location = jsonobject.getString("location");
                                            //String goal = jsonobject.getString("goal");
                                            System.out.println(name + "\n\n");

                                            farms_data_strings threeStrings = new farms_data_strings(name, location, "cal/3,5/2");
                                            threeStringsList.add(threeStrings);
                                        }
                                        //ListView yourListView = (ListView) findViewById(R.id.farms_list);
                                        // get data from the table by the ListAdapter
                                        //ListAdapter customAdapter = new ListAdapter(this, R.layout.farms_list_tools, List<yourItem>);

                                        farms_data_adapter customAdapter = new farms_data_adapter(getApplicationContext(), R.layout.farms_list_tools, threeStringsList);
                                        yourListView.setAdapter(customAdapter);


                                    } catch (JSONException ex) {
                                        ex.printStackTrace();
                                    }
                                }
        }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            // TODO: Handle error
                            //Toast.makeText(getApplicationContext(), "Error", Toast.LENGTH_LONG).show();
                            Toast.makeText(getApplicationContext(), (error).toString(), Toast.LENGTH_LONG).show();
                            //System.out.println((error).toString());
                        }
                    });
            requestQueue.add(jsonArrayRequest);
            //System.out.println("here here _"+jsonArrayRequest.getBody("name"));

        } catch (Exception e) {
            e.printStackTrace();
        }
       // return jsonArrayRequest;
    }


}