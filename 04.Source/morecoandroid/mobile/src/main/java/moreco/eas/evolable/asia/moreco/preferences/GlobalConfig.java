package moreco.eas.evolable.asia.moreco.preferences;

import android.content.Context;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class GlobalConfig extends BaseSharedPreferences {

    public final static String  KEY_MUSTTO_UPDATE_DICT_DATA  = "key_mustto_update_dict_data";
    public final static String  KEY_DICT_VERSION  = "key_dict_version";
    public final static String  KEY_DICT_VERSION_ID  = "key_dict_version_id";

    private BaseSharedPreferences mBaseSharedPreferences;


    public GlobalConfig(Context context) {
        super(context);
        mBaseSharedPreferences = new BaseSharedPreferences(context);
    }

    public String getKeyDictVersion() {
        return mBaseSharedPreferences.getString(KEY_DICT_VERSION);
    }

    public void setKeyDictVersion(String value) {
        mBaseSharedPreferences.setString(KEY_DICT_VERSION,value);
    }

    public int getKeyDictVersionId() {
        return mBaseSharedPreferences.getInt(KEY_DICT_VERSION_ID);
    }

    public void setKeyDictVersionId(int value) {
        mBaseSharedPreferences.setInt(KEY_DICT_VERSION_ID,value);
    }

    public boolean getKeyMusttoUpdateDictData() {
        return getBoolean(KEY_MUSTTO_UPDATE_DICT_DATA);
    }
    public void setKeyMusttoUpdateDictData(boolean value) {
        mBaseSharedPreferences.setBoolean(KEY_MUSTTO_UPDATE_DICT_DATA,value);
    }

}
