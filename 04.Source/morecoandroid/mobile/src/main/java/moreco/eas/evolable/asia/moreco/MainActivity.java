package moreco.eas.evolable.asia.moreco;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.widget.Toast;

import com.google.gson.JsonObject;

import moreco.eas.evolable.asia.moreco.adapter.ViewPageAdapter;
import moreco.eas.evolable.asia.moreco.fragment.AskFragment;
import moreco.eas.evolable.asia.moreco.fragment.HistoryFragment;
import moreco.eas.evolable.asia.moreco.fragment.MostUseFragment;
import moreco.eas.evolable.asia.moreco.fragment.SearchFragment;
import moreco.eas.evolable.asia.moreco.fragment.SettingFragment;
import moreco.eas.evolable.asia.moreco.util.DictionaryDataUtils;

public class MainActivity extends AppCompatActivity {
    private ViewPager mViewPager;
    private TabLayout mTabLayout;
    private DictionaryDataUtils mDictDataUtils;

    private int[] tabIcons = {
            R.drawable.find,
            R.drawable.favorites,
            R.drawable.history,
            R.drawable.ask,
            R.drawable.setting,
    };

    private class DictVesion extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
            mDictDataUtils = new DictionaryDataUtils();
            return null;
        }


        @Override
        protected void onCancelled() {
            super.onCancelled();
        }

        @Override
        protected void onPreExecute() {
            //start the progress dialog
            progress = ProgressDialog.show(MainActivity.this , null, "Confirm new dictionary version...");
            progress.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            progress.setIndeterminate(true);
            super.onPreExecute();
        }

        @Override

        protected void onPostExecute(Void result) {
            progress.dismiss();
            super.onPostExecute(result);
            JsonObject jsonObject = mDictDataUtils.requestDictionaryJsonObject(DictionaryDataUtils.REQUEST_DICTIONARY_VERSION_URL);
            String version = jsonObject.get("version").getAsString();
            int id = jsonObject.get("id").getAsInt();
            Toast.makeText(MainActivity.this, "Version" + version + "id :" + id, Toast.LENGTH_SHORT).show();

        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        mViewPager = (ViewPager) findViewById(R.id.viewpager);
        mViewPager.setOffscreenPageLimit(4);
        setupViewPager(mViewPager);

        mTabLayout = (TabLayout) findViewById(R.id.tabs);
        mTabLayout.setupWithViewPager(mViewPager);

        setupTabIcons();

        new DictVesion().execute();
    }

    @Override
    protected void onResume() {
        super.onResume();
    }




    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    /**
     * Setups viewPager for switching between pages according to the selected tab
     *
     * @param viewPager
     */
    private void setupViewPager(ViewPager viewPager) {

        ViewPageAdapter adapter = new ViewPageAdapter(getSupportFragmentManager());

        adapter.addFragment(new SearchFragment(), "Search");
        adapter.addFragment(new MostUseFragment(), "Most Use");
        adapter.addFragment(new HistoryFragment(), "History");
        adapter.addFragment(new AskFragment(), "Ask");
        adapter.addFragment(new SettingFragment(), "Setting");
        viewPager.setAdapter(adapter);
    }

    /**
     * Setups icons for 3 tabs
     */
    private void setupTabIcons() {
        mTabLayout.getTabAt(0).setIcon(tabIcons[0]);
        mTabLayout.getTabAt(1).setIcon(tabIcons[1]);
        mTabLayout.getTabAt(2).setIcon(tabIcons[2]);
        mTabLayout.getTabAt(3).setIcon(tabIcons[3]);
        mTabLayout.getTabAt(4).setIcon(tabIcons[4]);
    }
}
