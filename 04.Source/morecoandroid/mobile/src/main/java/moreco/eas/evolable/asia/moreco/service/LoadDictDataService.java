package moreco.eas.evolable.asia.moreco.service;

import android.app.IntentService;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.widget.Toast;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;

import moreco.eas.evolable.asia.moreco.MainActivity;
import moreco.eas.evolable.asia.moreco.database.MoreCoRealmDB;
import moreco.eas.evolable.asia.moreco.preferences.GlobalConfig;
import moreco.eas.evolable.asia.moreco.util.DictionaryDataUtils;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class LoadDictDataService extends IntentService {

    private DictionaryDataUtils mDictDataUtils;
    private MoreCoRealmDB mMoreCoRealmDB;

    private GlobalConfig mGlobalConfig;

    public LoadDictDataService(){
        super("LoadDictDataService");

    }
    @Override
    protected void onHandleIntent(Intent intent) {

//        new LoadDictVesion().execute();

    }

    private class LoadDictVesion extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
            mDictDataUtils = new DictionaryDataUtils();
            mGlobalConfig = new GlobalConfig(LoadDictDataService.this);
            return null;
        }


        @Override
        protected void onCancelled() {
            super.onCancelled();
        }

        @Override
        protected void onPreExecute() {
            //start the progress dialog
            progress = ProgressDialog.show(LoadDictDataService.this, null, "Confirm new dictionary version...");
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
                Toast.makeText(LoadDictDataService.this, "Version" + version + "id :" + id, Toast.LENGTH_SHORT).show();
            } else {
                mGlobalConfig.setKeyDictVersion(version);
                mGlobalConfig.setKeyDictVersionId(id);

//                Toast.makeText(MainActivity.this, "Downloading new Version :" + version + "   id : " + id, Toast.LENGTH_SHORT).show();
            }

        }

    }
    private class LoadDictData extends AsyncTask<Void, Void, Void> {
        private ProgressDialog progress = null;

        protected void onError(Exception ex) {
        }

        @Override
        protected Void doInBackground(Void... params) {
            mMoreCoRealmDB = new MoreCoRealmDB(LoadDictDataService.this);
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
            progress = ProgressDialog.show(LoadDictDataService.this , null, "Downloading the new dictionary data...");
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
            mMoreCoRealmDB.writetoDictVersionDB(version,versionId);

            JsonArray dictLanguages = jsonObject.getAsJsonObject("DictLanguage").getAsJsonArray();
            for (int i = 0; i <= dictLanguages.size(); i++){
                int id = dictLanguages.get(i).getAsJsonObject().get("id").getAsInt();
                int status = dictLanguages.get(i).getAsJsonObject().get("status").getAsInt();
                String code = dictLanguages.get(i).getAsJsonObject().get("code").getAsString();
                mMoreCoRealmDB.writetoDictLanguagesDB(id,code,status);
            }
//                JsonElement element = new ArrayList<JsonElement>();
//                int id = jsonObject.get("id").getAsInt();
//
//                String dictversion = mGlobalConfig.getKeyDictVersion();
//                int versionId = mGlobalConfig.getKeyDictVersionId();

            String versiondb = mMoreCoRealmDB.queryAllRealmDB().get(0).getVersion();
//
            Toast.makeText(LoadDictDataService.this, "Downloading  with new Version :" + versiondb , Toast.LENGTH_SHORT).show();


        }


        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }
    }
}
