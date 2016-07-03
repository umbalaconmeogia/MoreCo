package moreco.eas.evolable.asia.moreco;

import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.support.wearable.view.BoxInsetLayout;
import android.widget.TextView;

import service.WearService;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class UpdateMessageActivity extends WearMainActivity {
    private BoxInsetLayout mContainerView;
    private TextView mTextView;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_wear_main);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE);

        mContainerView = (BoxInsetLayout) findViewById(R.id.container);
        mTextView = (TextView) findViewById(R.id.maintext);
    }

    @Override
    protected void onResume() {
        super.onResume();
        Bundle bundle = getIntent().getExtras();
        mTextView.setText(bundle.getString(WearService.EXTRA_KEY_MESSAGE));
        mTextView.setTextSize(60L);
    }

    @Override
    public Intent getIntent() {
        return super.getIntent();
    }

    @Override
    protected void onStop() {
        super.onStop();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
    }

    @Override
    protected void onPause() {
        super.onPause();
    }
}
