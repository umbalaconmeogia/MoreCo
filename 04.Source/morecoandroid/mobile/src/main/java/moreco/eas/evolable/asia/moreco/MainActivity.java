package moreco.eas.evolable.asia.moreco;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonObject;

import moreco.eas.evolable.asia.moreco.adapter.ViewPageAdapter;
import moreco.eas.evolable.asia.moreco.database.MoreCoRealmDB;
import moreco.eas.evolable.asia.moreco.fragment.AskFragment;
import moreco.eas.evolable.asia.moreco.fragment.SearchFragment;
import moreco.eas.evolable.asia.moreco.preferences.GlobalConfig;
import moreco.eas.evolable.asia.moreco.util.DictionaryDataUtils;

public class MainActivity extends AppCompatActivity {
    private ViewPager mViewPager;
    private TabLayout mTabLayout;
    private DictionaryDataUtils mDictDataUtils;
    private MoreCoRealmDB mMoreCoRealmDB;

    private GlobalConfig mGlobalConfig;
    private TextView mTitleView;
    private ImageView mLang1Btn;
    private ImageView mLang2Btn;

    private int[] tabIcons = {
            R.drawable.find,
//            R.drawable.favorites,
//            R.drawable.history,
            R.drawable.ask,
//            R.drawable.setting,
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        mTitleView = (TextView) findViewById(R.id.title);
        mLang1Btn = (ImageView) findViewById(R.id.lang1);
        mLang2Btn = (ImageView) findViewById(R.id.lang2);

        mViewPager = (ViewPager) findViewById(R.id.viewpager);
        mViewPager.setOffscreenPageLimit(4);
        setupViewPager(mViewPager);

        mTabLayout = (TabLayout) findViewById(R.id.tabs);
        mTabLayout.setupWithViewPager(mViewPager);
        mViewPager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

            }

            @Override
            public void onPageSelected(int position) {
                if(position == 0) {
                    mTitleView.setText("Search");
                    mLang1Btn.setVisibility(View.VISIBLE);
                    mLang2Btn.setVisibility(View.VISIBLE);
                } else if(position == 1){
                    mTitleView.setText("Ask");
                    mLang1Btn.setVisibility(View.GONE);
                    mLang2Btn.setVisibility(View.GONE);
                }

            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }
        });

        setupTabIcons();

//        Intent intent = new Intent(MainActivity.this, LoadDictDataService.class);
//        startService(intent);

        mDictDataUtils = new DictionaryDataUtils();
        mGlobalConfig = new GlobalConfig(MainActivity.this);
        mMoreCoRealmDB = new MoreCoRealmDB(MainActivity.this);

        new LoadDictVesion().execute();

        if (mGlobalConfig.getKeyMusttoUpdateDictData()) {
            new LoadDictData().execute();
        }
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
//        adapter.addFragment(new MostUseFragment(), "Most Use");
//        adapter.addFragment(new HistoryFragment(), "History");
        adapter.addFragment(new AskFragment(), "Ask");
//        adapter.addFragment(new SettingFragment(), "Setting");
        viewPager.setAdapter(adapter);
    }

    /**
     * Setups icons for 3 tabs
     */
    private void setupTabIcons() {
        mTabLayout.getTabAt(0).setIcon(tabIcons[0]);
        mTabLayout.getTabAt(1).setIcon(tabIcons[1]);
//        mTabLayout.getTabAt(2).setIcon(tabIcons[2]);
//        mTabLayout.getTabAt(3).setIcon(tabIcons[3]);
//        mTabLayout.getTabAt(4).setIcon(tabIcons[4]);
    }

    private class LoadDictVesion extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
            return null;
        }


        @Override
        protected void onCancelled() {
            super.onCancelled();
        }

        @Override
        protected void onPreExecute() {
            //start the progress dialog
            progress = ProgressDialog.show(MainActivity.this, null, "Confirm new dictionary version...");
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

            String dictversion = mGlobalConfig.getKeyDictVersion();
            int versionId = mGlobalConfig.getKeyDictVersionId();

            if (dictversion.equals(version) && id == versionId) {
                mGlobalConfig.setKeyMusttoUpdateDictData(false);
                Toast.makeText(MainActivity.this, "Version" + version + "id :" + id, Toast.LENGTH_SHORT).show();
            } else {
                mGlobalConfig.setKeyDictVersion(version);
                mGlobalConfig.setKeyDictVersionId(id);
                mGlobalConfig.setKeyMusttoUpdateDictData(true);
            }

        }

    }

    private class LoadDictData extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
//                mDictDataUtils = new DictionaryDataUtils();
//                mGlobalConfig = new GlobalConfig(MainActivity.this);
            return null;
        }


        @Override
        protected void onCancelled() {
            super.onCancelled();
        }

        @Override
        protected void onPreExecute() {
            //start the progress dialog
            progress = ProgressDialog.show(MainActivity.this, null, "Downloading the new dictionary data...");
            progress.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            progress.setIndeterminate(true);
            super.onPreExecute();
        }

        @Override

        protected void onPostExecute(Void result) {
            progress.dismiss();
            super.onPostExecute(result);
            JsonObject jsonObject = mDictDataUtils.requestDictionaryJsonObject(DictionaryDataUtils.REQUEST_DICTIONARY_DATA_URL);
            String version = jsonObject.getAsJsonObject("DictVersion").get("version").getAsString();
            int versionId = jsonObject.getAsJsonObject("DictVersion").get("id").getAsInt();

            mMoreCoRealmDB.writetoDictVersionDB(version, versionId);
            JsonArray dictLanguages = jsonObject.getAsJsonArray("DictLanguages");
            if (BuildConfig.DEBUG) {
                Log.d("LoadDictData", "dictLanguages.size():" + dictLanguages.size());
            }

            for (JsonElement jsonElement : dictLanguages) {
                int langid = jsonElement.getAsJsonObject().get("id").getAsInt();
                String code = jsonElement.getAsJsonObject().get("code").getAsString();
                int status1 = jsonElement.getAsJsonObject().get("data_status").getAsInt();
                if (BuildConfig.DEBUG)
                    Log.d("LoadDictData", "Success insert id :" + langid + "  code : " + code + "  status" + status1);
                mMoreCoRealmDB.writetoDictLanguagesDB(langid, code, status1);
            }


            JsonArray dictLanguagesNames = jsonObject.getAsJsonArray("DictLanguageNames");
            for (JsonElement dictlanguagesname : dictLanguagesNames) {
                int langnameid = dictlanguagesname.getAsJsonObject().get("id").getAsInt();
                int language_id = dictlanguagesname.getAsJsonObject().get("dict_language_id").getAsInt();
                int in_language_id = dictlanguagesname.getAsJsonObject().get("in_language_id").getAsInt();
                int status2 = dictlanguagesname.getAsJsonObject().get("data_status").getAsInt();
                String name = dictlanguagesname.getAsJsonObject().get("name").getAsString();
                mMoreCoRealmDB.writetoDictLanguagesNameDB(langnameid, language_id, in_language_id, name, status2);
            }

            JsonArray dictSentences = jsonObject.getAsJsonArray("DictSentences");
            for (JsonElement dictsentences : dictSentences) {
                int sentenceid = dictsentences.getAsJsonObject().get("id").getAsInt();
                int sentence_data_status = dictSentences.getAsJsonObject().get("data_status").getAsInt();
                mMoreCoRealmDB.writetoDictSentenceDB(sentenceid, sentence_data_status);
            }

            JsonArray dictSentenceTranslations = jsonObject.getAsJsonArray("DictSentenceTranslations");
            for (JsonElement dictsentenceTranslation : dictSentenceTranslations) {
                int sentransid = dictsentenceTranslation.getAsJsonObject().get("id").getAsInt();
                int dict_language_id = dictsentenceTranslation.getAsJsonObject().get("dict_language_id").getAsInt();
                int dict_sentence_id = dictsentenceTranslation.getAsJsonObject().get("dict_sentence_id").getAsInt();
                String translated_sentence = dictsentenceTranslation.getAsJsonObject().get("translated_sentence").getAsString();
                String search_tex = dictsentenceTranslation.getAsJsonObject().get("searching_text").getAsString();
                int senttranstatus = dictsentenceTranslation.getAsJsonObject().get("data_status").getAsInt();
                mMoreCoRealmDB.writetoDictSentenceTranslationDB(sentransid, dict_language_id, dict_sentence_id, translated_sentence, search_tex, senttranstatus);
            }
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }
    }
}
