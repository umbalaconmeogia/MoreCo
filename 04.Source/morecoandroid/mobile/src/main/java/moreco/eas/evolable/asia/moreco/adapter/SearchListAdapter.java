package moreco.eas.evolable.asia.moreco.adapter;

import android.app.Activity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

import moreco.eas.evolable.asia.moreco.R;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class SearchListAdapter extends ArrayAdapter<String> {

    private Activity context;
    private final List<String> list;

    public SearchListAdapter(Activity context, ArrayList<String> list) {
        super(context, R.layout.search_list_layout, list);
        this.list = list;
        this.context = context;
    }

    @Override
    public View getView(final int position, View convertView, final ViewGroup parent) {
        if (convertView == null) {
            convertView = context.getLayoutInflater().inflate(R.layout.search_list_layout, parent, false);
        }
        TextView title = (TextView) convertView.findViewById(R.id.text);

        String sentence = list.get(position);
        title.setText(sentence);
        return convertView;
    }

    @Override
    public long getItemId(int i) {
        return getItem(i).hashCode();
    }
}
