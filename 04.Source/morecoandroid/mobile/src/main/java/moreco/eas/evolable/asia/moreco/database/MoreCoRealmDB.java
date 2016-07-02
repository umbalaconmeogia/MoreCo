package moreco.eas.evolable.asia.moreco.database;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */

import android.content.Context;

import io.realm.Realm;
import io.realm.RealmConfiguration;
import io.realm.RealmQuery;
import io.realm.RealmResults;

/**
 * Created by PhanVanTrung on 2016/06/07.
 */
public class MoreCoRealmDB {

    private Realm mRealm;

    public MoreCoRealmDB(Context context) {
        /// Create a RealmConfiguration that saves the Realm file in the app's "files" directory.
        RealmConfiguration realmConfig = new RealmConfiguration.Builder(context).build();
        Realm.setDefaultConfiguration(realmConfig);

        // Get a Realm instance for this thread
        mRealm = Realm.getInstance(realmConfig);
    }

    public void writetoRealmDB(String version, int versionId) {
        mRealm.beginTransaction();
        // Create a new object
        DictDataModel dictDataModel = mRealm.createObject(DictDataModel.class);
        dictDataModel.setVersion(version);
        dictDataModel.setVersionId(versionId);
        mRealm.commitTransaction();
    }


    public RealmResults<DictDataModel> queryAllRealmDB() {
        RealmQuery<DictDataModel> query = mRealm.where(DictDataModel.class);
        RealmResults<DictDataModel> resultAll = query.findAll();
        return resultAll;
    }

    public DictDataModel getPlayListModelfromRealmDB(int versionId) {
        RealmQuery<DictDataModel> query = mRealm.where(DictDataModel.class);
        query.equalTo("id", versionId);
        RealmResults<DictDataModel> result = query.findAll();
        return result.get(0);
    }
}
