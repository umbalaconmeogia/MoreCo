package moreco.eas.evolable.asia.moreco.fragment;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import moreco.eas.evolable.asia.moreco.R;
import com.nhaarman.listviewanimations.itemmanipulation.DynamicListView;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class HistoryFragment extends Fragment {

    private DynamicListView recentlyMessageListView;

    @Override
    public void onStop() {
        super.onStop();
    }

    @Override
    public void onPause() {
        super.onPause();
    }

    @Override
    public void onStart() {
        super.onStart();
    }

    @Override
    public void onResume() {
        super.onResume();
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.layout_history_fragment, container, false);

        recentlyMessageListView = (DynamicListView) view.findViewById(R.id.recently_message);
        return view;
    }
}
