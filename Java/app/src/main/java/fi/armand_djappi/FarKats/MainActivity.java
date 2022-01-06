package fi.armand_djappi.FarKats;

import androidx.appcompat.app.AppCompatActivity;

import android.content.ClipData;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.TableLayout;
import android.widget.TableRow;

import androidx.appcompat.widget.Toolbar;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //Toolbar toolbar               = (Toolbar) findViewById(R.id.toolbar);
        //setSupportActionBar(toolbar);
        //toolbar.setNavigationIcon(R.drawable.ic_home);
        // calling the display notification function with the data to display in the main page
        //String[] the_payment    = this.displayNotification();

        //todo : continue with populate date into listview n
        // creating an Empty Integer List
        List<farms_data_strings> threeStringsList = new ArrayList<>();
        farms_data_strings threeStrings = new farms_data_strings("djappi farm", "Tampere", "cal/3,5/2");
        threeStringsList.add(threeStrings);


        ListView yourListView = (ListView) findViewById(R.id.farms_list);

       // get data from the table by the ListAdapter

        //ListAdapter customAdapter = new ListAdapter(this, R.layout.farms_list_tools, List<yourItem>);
        farms_data_adapter customAdapter = new farms_data_adapter(this, R.layout.farms_list_tools, threeStringsList);

        yourListView.setAdapter(customAdapter);

        yourListView.setTextFilterEnabled(true);
        //listView.setAdapter(adapter);
        yourListView.setFocusable(true);


    }
}