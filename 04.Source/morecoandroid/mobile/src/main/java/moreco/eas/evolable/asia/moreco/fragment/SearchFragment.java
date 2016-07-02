package moreco.eas.evolable.asia.moreco.fragment;

import android.app.ProgressDialog;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.StrictMode;
import android.speech.tts.TextToSpeech;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.ListFragment;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.wearable.DataApi;
import com.google.android.gms.wearable.DataItem;
import com.google.android.gms.wearable.DataMap;
import com.google.android.gms.wearable.DataMapItem;
import com.google.android.gms.wearable.MessageApi;
import com.google.android.gms.wearable.Node;
import com.google.android.gms.wearable.NodeApi;
import com.google.android.gms.wearable.PutDataRequest;
import com.google.android.gms.wearable.Wearable;
import com.nhaarman.listviewanimations.itemmanipulation.DynamicListView;

import java.util.ArrayList;
import java.util.Collection;
import java.util.HashSet;
import java.util.List;
import java.util.Locale;

import moreco.eas.evolable.asia.moreco.BuildConfig;
import moreco.eas.evolable.asia.moreco.Constant;
import moreco.eas.evolable.asia.moreco.R;
import moreco.eas.evolable.asia.moreco.adapter.SearchListAdapter;
import moreco.eas.evolable.asia.moreco.database.DictSentenceTranslationDataModel;
import moreco.eas.evolable.asia.moreco.database.MoreCoRealmDB;
import moreco.eas.evolable.asia.moreco.searchtext.moreco.searchlib.SearchDataRecord;
import moreco.eas.evolable.asia.moreco.searchtext.moreco.searchlib.SearchLib;
import com.nhaarman.listviewanimations.appearance.simple.SwingBottomInAnimationAdapter;
import moreco.eas.evolable.asia.moreco.util.EditTextUtils;
import moreco.eas.evolable.asia.moreco.util.GoogleTranslateUtils;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class SearchFragment extends Fragment implements GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener, TextToSpeech.OnInitListener {
    private GoogleApiClient mGoogleApiClient;
    private MessageApi.MessageListener mMessageListener;
    private DataApi.DataListener mDataListener;
    private EditText mEditText;
    private GoogleTranslateUtils mTranslator;
    private ListView mSearchListView;
    private String mGoogleTranslateResult = "";
    private MoreCoRealmDB mMoreCoRealmDB;
    private SearchListAdapter mSearchListAdapter;
    private ArrayList<String> searchResults;

    private TextToSpeech mTextToSpeech;
    private int count = 0;
    private static final String START_ACTIVITY_PATH = "/start/WearMainActivity";
    private static final String DATA_API_EXTRA_KEY = "DATA_API_EXTRA_KEY";
    private static final String DATA_API_PATH = "DATA_API_PATH ";
    private static final String COUNT_KEY = "COUNT_KEY";
    private static final String COUNT_PATH = "/count";

    @Override
    public void onConnected(Bundle bundle) {
        Log.d("test", "onConnected");
        new AsyncTask<Void, Void, Void>() {
            @Override
            protected Void doInBackground(Void... voids) {
                restoreCurrentCount();
                return null;
            }
        }.execute();
    }

    /**
     * Setups custom adapter which enables animations when adding elements
     */
    private void setupListViewAndAdapter() {
//        sentencesListAdapter = new VideosAdapter(getActivity(), searchResultsList, false);
//        SwingBottomInAnimationAdapter animationAdapter = new SwingBottomInAnimationAdapter(videoListAdapter);
//        animationAdapter.setAbsListView(videosFoundListView);
//        videosFoundListView.setAdapter(animationAdapter);
    }

    @Override
    public void onConnectionSuspended(int i) {
    }

    @Override
    public void onConnectionFailed(ConnectionResult connectionResult) {
        Log.e("test", "Failed to connect to Google API Client");
    }

    @Override
    public void onStop() {
        super.onStop();
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
    public void onPause() {
        super.onPause();
        if (mGoogleApiClient.isConnected()) {
            Wearable.DataApi.removeListener(mGoogleApiClient, mDataListener);
            Wearable.MessageApi.removeListener(mGoogleApiClient, mMessageListener);
            mGoogleApiClient.disconnect();
        }
    }

    @Override
    public void onDestroy() {
        mGoogleApiClient.disconnect();
        if (mTextToSpeech != null) {
            mTextToSpeech.stop();
            mTextToSpeech.shutdown();
        }
        super.onDestroy();
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        mGoogleApiClient = new GoogleApiClient.Builder(getActivity())
                .addApi(Wearable.API)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .build();
        mGoogleApiClient.connect();

        mTextToSpeech = new TextToSpeech(getActivity(), this);
    }

    private void restoreCurrentCount() {
        String localNodeId = getLocalNodeId();
        Uri uri = new Uri.Builder().scheme(PutDataRequest.WEAR_URI_SCHEME).authority(localNodeId).path(COUNT_PATH).build();
        Wearable.DataApi.getDataItem(mGoogleApiClient, uri).setResultCallback(new ResultCallback<DataApi.DataItemResult>() {
            @Override
            public void onResult(DataApi.DataItemResult dataItemResult) {
                DataItem dataItem = dataItemResult.getDataItem();
                if (dataItem != null) {
                    DataMap dataMap = DataMapItem.fromDataItem(dataItemResult.getDataItem()).getDataMap();
                    count = dataMap.getInt(COUNT_KEY);
                    Log.d("MainActivity", "restored count:" + count);
                }
            }
        });
    }

    private String getLocalNodeId() {
        NodeApi.GetLocalNodeResult nodeResult = Wearable.NodeApi.getLocalNode(mGoogleApiClient).await();
        return nodeResult.getNode().getId();
    }

    /**
     * Send message to Android Wear by START_ACTIVITY_PATH
     *
     * @param message
     */
    private void sendMessageToStartActivity(String message) {
        Collection<String> nodes = getNodes();
        for (String node : nodes) {
            Wearable.MessageApi.sendMessage(mGoogleApiClient, node, START_ACTIVITY_PATH, message.getBytes()).setResultCallback(new ResultCallback<MessageApi.SendMessageResult>() {
                @Override
                public void onResult(@NonNull MessageApi.SendMessageResult sendMessageResult) {
                    Log.v("MainActivity", sendMessageResult.toString());
                }
            });
        }
    }

    /**
     * get nodes in transmission
     *
     * @return
     */
    private Collection<String> getNodes() {
        HashSet<String> results = new HashSet<String>();
        NodeApi.GetConnectedNodesResult nodes =
                Wearable.NodeApi.getConnectedNodes(mGoogleApiClient).await();
        for (Node node : nodes.getNodes()) {
            results.add(node.getId());
        }
        return results;
    }


    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.layout_search_fragment, container, false);

        mSearchListView = (ListView) view.findViewById(R.id.search_list);

        int SDK_INT = android.os.Build.VERSION.SDK_INT;
        if (SDK_INT > 9)
        {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }

        mMoreCoRealmDB = new MoreCoRealmDB(getActivity());

        mEditText = (EditText) view.findViewById(R.id.edittext);
        mEditText.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View view, boolean b) {
                if (!b) {
                    EditTextUtils.hideSoftKeyboard(getActivity(), view);
                }
            }
        });

        ((Button) view.findViewById(R.id.sendbtn)).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String searchText = "私は部屋の鍵でルームに";
                List<SearchDataRecord> searchData = createDataTestJapanese();
                List<SearchDataRecord> searchResult = SearchLib.search(searchText, SearchLib.LANG_CODE_JAPANESE, searchData, 0);
                searchResults = new ArrayList<String>();

                for (int i = 0; i < searchResult.size(); i++) {
                    String sentence = searchResult.get(i).getSearchData();

                    searchResults.add(sentence);
                    if (BuildConfig.DEBUG) Log.d("SearchFragment", "sentence " + i + " : " + sentence);
                }
                ArrayAdapter adapter = new ArrayAdapter<String>(getActivity(), R.layout.search_list_layout, searchResults);

//                mSearchListAdapter = new SearchListAdapter(getActivity(), searchResults);
                mSearchListView.setAdapter(adapter);

                new Translator().execute();
//                String message = "";
//                if (mEditText.getText() != null) {
//                    message = mEditText.getText().toString();
//                }


                if (mGoogleApiClient.isConnected()) {
                    new AsyncTask<String, Void, Void>() {
                        @Override
                        protected Void doInBackground(String... params) {
                            sendMessageToStartActivity(params[0]);
                            return null;
                        }
                    }.execute(mGoogleTranslateResult);
                }
                speakOut();
//                Asset asset = null;
//                try {
//                    asset = Asset.createFromBytes("Android端末からのデータ".getBytes());
//                } catch (Exception e){
//
//                }
//
//                final PutDataRequest req = PutDataRequest.create(DATA_API_PATH);
//                req.putAsset(DATA_API_EXTRA_KEY,asset);
//                NodeApi.GetConnectedNodesResult nodes = Wearable.NodeApi.getConnectedNodes(mGoogleApiClient).await();
//                for (Node node : nodes.getNodes()) {
//                    DataApi.DataItemResult result = Wearable.DataApi.putDataItem(mGoogleApiClient,req).await();
//
//                }
            }
        });


        return view;

    }

    @Override
    public void onInit(int status) {

        if (status == TextToSpeech.SUCCESS) {

            int result = mTextToSpeech.setLanguage(Locale.US);

            if (result == TextToSpeech.LANG_MISSING_DATA
                    || result == TextToSpeech.LANG_NOT_SUPPORTED) {
                Toast.makeText(getActivity(), "This Language is not supported", Toast.LENGTH_SHORT).show();
            } else {
                speakOut();
            }

        } else {
            Toast.makeText(getActivity(), "Initilization Failed!", Toast.LENGTH_SHORT).show();
        }

    }

    private void speakOut() {
        String text = mEditText.getText().toString();
        if (!TextUtils.isEmpty(text))
            mTextToSpeech.speak(text, TextToSpeech.QUEUE_FLUSH, null);
    }


    private class Translator extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
            try {
                mTranslator = new GoogleTranslateUtils(Constant.GOOGLE_TRANSLATE_API_KEY);
                Thread.sleep(1000);
            } catch (Exception e) {
                e.printStackTrace();

            }

            return null;
        }


        @Override
        protected void onCancelled() {
            super.onCancelled();
        }

        @Override
        protected void onPreExecute() {
            //start the progress dialog
            progress = ProgressDialog.show(getActivity(), null, "Translating...");
            progress.setProgressStyle(ProgressDialog.STYLE_SPINNER);
            progress.setIndeterminate(true);
            super.onPreExecute();
        }

        @Override

        protected void onPostExecute(Void result) {

            progress.dismiss();
            super.onPostExecute(result);
            translated();
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }
    }

    /**
     * https://cloud.google.com/translate/v2/translate-reference#supported_languages
     * Support language list
     */
    public void translated() {
        String translatelog = mEditText.getText().toString();//get the value of text
        mGoogleTranslateResult = mTranslator.translate(translatelog, "en", "ja");
//        Toast.makeText(getActivity(), translatelog, Toast.LENGTH_LONG).show();
        Toast.makeText(getActivity(), mGoogleTranslateResult , Toast.LENGTH_LONG).show();
    }

//    public void searchtext() {
//        String searchText = "私は部屋の鍵でルームに";
//        List<SearchDataRecord> searchData = createDataTestJapanese();
//        List<SearchDataRecord> searchResult = SearchLib.search(searchText, SearchLib.LANG_CODE_JAPANESE, searchData, 0);
//        for (int i = 0; i < searchResult.size(); i++) {
//            System.out.println(searchResult.get(i).getSearchData());
//        }
//    }

    private static List<SearchDataRecord> createDataTestJapanese() {
        String[] testData = {
                "チェックインをお願いします。名前は{0}です。",
                "これが予約確認書です。",
                "予約してません。空いている部屋はありますか？",
                "シングル１部屋で、２泊です。",
                "ダブルルーム１部屋で１泊です。",
                "ツインルーム１部屋で３泊です。",
                "バスルーム/シャワーつきの部屋ですか？",
                "ご予約頂いている{0}様ですね。",
                "空いている部屋はございます。どうぞ、お泊まり下さい。",
                "あいにく、空いている部屋はございません。",
                "こちらのフォームにご記入下さい。",
                "お支払はクレジットカードですか？",
                "では、クレジットカードをお願い致します。",
                "有難うございました。（カードを返す。）",
                "料金は前払いとなっております。{0}ドルをお願い致します。",
                "有難うございました。こちらが領収書です。",
                "お部屋の番号は{0}になります。こちらが鍵です。",
                "お部屋は２階です。",
                "お部屋は３階です。",
                "今、係りの者がお部屋までご案内いたします。",
                "外出の際は、鍵をフロントにお預け下さい。",
                "朝食はカフェテリアでお取り頂けます。",
                "朝食は料金に含まれています。",
                "カフェテリアは１階、あちらにございます。 (方向を手で示しながら。）",
        };
        return createDataTest(testData);
    }

    private static List<SearchDataRecord> createDataTest(String[] testData) {
        List<SearchDataRecord> result = new ArrayList<SearchDataRecord>();
        for (int i = 0; i < testData.length; i++) {
            result.add(new TestSearchData(testData[i]));
        }

        return result;
    }
    /**
     * Data model used for testing.
     */
    static class TestSearchData implements SearchDataRecord
    {
        private String text;

        public TestSearchData(String text) {
            this.text = text;
        }

        @Override
        public String getSearchData() {
            return text;
        }
    }


}
