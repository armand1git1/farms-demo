package fi.armand_djappi.FarKats;

import android.content.ClipData;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.List;

public class farms_data_adapter extends ArrayAdapter<farms_data_strings> {
    private int resourceLayout;
    private Context mContext;

    public farms_data_adapter(Context context, int resource, List<farms_data_strings> items) {
    //public farms_data_adapter(Context context, int resource, List<String> items) {
        super(context, resource, items);
        this.resourceLayout = resource;
        this.mContext = context;
    }



    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        View v = convertView;

        if (v == null) {
            LayoutInflater vi;
            vi = LayoutInflater.from(mContext);
            v = vi.inflate(resourceLayout, null);
        }

        farms_data_strings p = getItem(position);

        if (p != null) {
            TextView tt1 = (TextView) v.findViewById(R.id.txtfarmNameval);
            TextView tt2 = (TextView) v.findViewById(R.id.txtlocationval);
            TextView tt3 = (TextView) v.findViewById(R.id.txtdetailsval);

            if (tt1 != null) {
                //tt1.setText(p1.getId());
                //tt1.setText(this.getId(position));
                //tt1.setText("farms");
                tt1.setText(p.getLeft());
            }

            if (tt2 != null) {
                //tt2.setText(p.getCategory().getId());
                tt2.setText(p.getRight());

            }

            if (tt3 != null) {
                //tt3.setText(p.getDescription());
                tt3.setText(p.getCentre());
            }
        }

        return v;
    }

}

